<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    /**
     * Display the dynamic Home / Landing page.
     */
    public function index()
    {
        $featuredProjects = Project::where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('order')
            ->take(6)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        $testimonials = Testimonial::where('is_published', true)
            ->orderBy('order')
            ->get();

        $recentPosts = Post::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $experiences = Experience::orderBy('created_at', 'desc')->take(3)->get();
        $skills = ResumeItem::where('type', 'skill')->orderBy('order')->get();
        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.index', compact(
            'featuredProjects',
            'services',
            'testimonials',
            'recentPosts',
            'experiences',
            'skills',
            'settings'
        ));
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $skills = ResumeItem::where('type', 'skill')->orderBy('order')->get();
        $experiences = Experience::orderBy('created_at', 'desc')->get();

        return view('frontend.about', compact('settings', 'skills', 'experiences'));
    }

    /**
     * Display the Experience timeline page with education and certifications.
     */
    public function experience()
    {
        $experiences = Experience::orderBy('created_at', 'desc')->get();
        $educations = ResumeItem::where('type', 'education')->orderBy('order')->get();
        $trainings = ResumeItem::where('type', 'training')->orderBy('order')->get();
        $activeCv = Cv::where('is_active', true)->latest()->first();
        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.experience', compact('experiences', 'educations', 'trainings', 'activeCv', 'settings'));
    }

    /**
     * Display dynamic Projects catalog with category filtering and search.
     */
    public function projects(Request $request)
    {
        $query = Project::where('is_published', true)->orderBy('order')->orderBy('created_at', 'desc');

        $activeCategory = $request->query('category', 'All');
        if ($activeCategory && $activeCategory !== 'All') {
            $query->where('category', $activeCategory);
        }

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('technology', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->get();

        $categories = Project::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.projects', compact('projects', 'categories', 'activeCategory', 'search', 'settings'));
    }

    /**
     * Display a single dynamic project with deep-dive case study & use case.
     */
    public function projectSingle(string $slug)
    {
        $project = Project::where('slug', $slug)->where('is_published', true)->firstOrFail();

        $relatedProjects = Project::where('is_published', true)
            ->where('id', '!=', $project->id)
            ->inRandomOrder()
            ->take(2)
            ->get();

        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.project-single', compact('project', 'relatedProjects', 'settings'));
    }

    /**
     * Display dynamic Blog posts listing with category filter and search.
     */
    public function blog(Request $request)
    {
        $query = Post::where('is_published', true)->orderBy('created_at', 'desc');

        $activeCategory = $request->query('category', 'All');
        if ($activeCategory && $activeCategory !== 'All') {
            $query->where('category', $activeCategory);
        }

        $activeTag = $request->query('tag');
        if ($activeTag) {
            $query->where('tags', 'like', "%{$activeTag}%");
        }

        $search = $request->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $posts = $query->get();

        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.blog', compact('posts', 'categories', 'activeCategory', 'activeTag', 'search', 'settings'));
    }

    /**
     * Display a single dynamic Blog post with YouTube embed, social sharing & comments.
     */
    public function blogSingle(string $slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // Safe increment of views
        $post->increment('views_count');

        $comments = $post->approvedComments()->latest()->get();

        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::where('is_published', true)
                ->where('id', '!=', $post->id)
                ->latest()
                ->take(3)
                ->get();
        }

        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.blog-single', compact('post', 'comments', 'relatedPosts', 'settings'));
    }

    /**
     * Submit a comment on a blog post.
     */
    public function commentSubmit(Request $request, int $postId)
    {
        $request->validate([
            'guest_name' => 'required|string|max:100',
            'guest_email' => 'nullable|email|max:150',
            'content' => 'required|string|max:2000',
        ]);

        $post = Post::findOrFail($postId);

        Comment::create([
            'post_id' => $post->id,
            'guest_name' => strip_tags($request->guest_name),
            'guest_email' => strip_tags($request->guest_email),
            'content' => strip_tags($request->content),
            'is_approved' => true, // Instant approval for good UX
        ]);

        return back()->with('comment_success', 'Thank you! Your comment has been posted successfully.');
    }

    /**
     * Display the dynamic Curriculum Vitae (CV) page.
     */
    public function cv()
    {
        $experiences = ResumeItem::where('type', 'experience')->orderBy('order')->get();
        $educations = ResumeItem::where('type', 'education')->orderBy('order')->get();
        $trainings = ResumeItem::where('type', 'training')->orderBy('order')->get();
        $languages = ResumeItem::where('type', 'language')->orderBy('order')->get();
        $volunteers = ResumeItem::where('type', 'volunteer')->orderBy('order')->get();
        $references = ResumeItem::where('type', 'reference')->orderBy('order')->get();
        $skills = ResumeItem::where('type', 'skill')->orderBy('order')->get();

        $activeCv = Cv::where('is_active', true)->latest()->first();
        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.cv', compact(
            'experiences',
            'educations',
            'trainings',
            'languages',
            'volunteers',
            'references',
            'skills',
            'activeCv',
            'settings'
        ));
    }

    /**
     * Download the active CV file or generate print stream.
     */
    public function downloadCv()
    {
        $activeCv = Cv::where('is_active', true)->latest()->first();

        if ($activeCv && File::exists(public_path($activeCv->file_path))) {
            return response()->download(public_path($activeCv->file_path), 'Md_Rabbi_Hasan_CV.pdf');
        }

        return redirect()->route('cv')->with('info', 'Please use the Print / Save as PDF button on this page.');
    }

    /**
     * Display Contact page.
     */
    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->all();

        return view('frontend.contact', compact('settings'));
    }

    /**
     * Handle Contact form submission.
     */
    public function contactSubmit(Request $request, GeminiService $gemini)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:3000',
        ]);

        try {
            $autoReply = $gemini->generateAutoReply($request->message);
            $responseMessage = 'Thank you for reaching out! Rabbi Hasan has received your message and will reply shortly. AI note: '.$autoReply;
        } catch (\Throwable $e) {
            $responseMessage = 'Thank you for reaching out! Rabbi Hasan has received your message and will respond shortly.';
        }

        return back()->with('success', $responseMessage);
    }

    /**
     * Newsletter subscription.
     */
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:subscribers,email']);
        Subscriber::create(['email' => $request->email]);

        return back()->with('success', 'Thank you for subscribing to my technical newsletter!');
    }

    /**
     * Dynamic XML Sitemap generation for Full SEO.
     */
    public function sitemap(): Response
    {
        $baseUrl = url('/');

        $pages = [
            ['url' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('experience'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('projects'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('blog'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('cv'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => route('contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        $projects = Project::where('is_published', true)->get();
        foreach ($projects as $project) {
            $pages[] = [
                'url' => route('projects.single', $project->slug),
                'priority' => '0.85',
                'changefreq' => 'monthly',
                'lastmod' => $project->updated_at ? $project->updated_at->toAtomString() : now()->toAtomString(),
            ];
        }

        $posts = Post::where('is_published', true)->get();
        foreach ($posts as $post) {
            $pages[] = [
                'url' => route('blog.single', $post->slug),
                'priority' => '0.85',
                'changefreq' => 'monthly',
                'lastmod' => $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString(),
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($pages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars($page['url']).'</loc>';
            if (isset($page['lastmod'])) {
                $xml .= '<lastmod>'.$page['lastmod'].'</lastmod>';
            } else {
                $xml .= '<lastmod>'.now()->toAtomString().'</lastmod>';
            }
            $xml .= '<changefreq>'.$page['changefreq'].'</changefreq>';
            $xml .= '<priority>'.$page['priority'].'</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Dynamic robots.txt generation.
     */
    public function robots(): Response
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /dashboard\n";
        $content .= "\nSitemap: ".url('/sitemap.xml')."\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
