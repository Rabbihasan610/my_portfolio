<?php

namespace Tests\Feature;

use App\Filament\Pages\ManageSections;
use App\Models\Post;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FrontendPortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $settings = [
            'hero_title' => 'Md Rabbi Hasan',
            'hero_subtitle' => 'Mid-Level Laravel & PHP Developer',
            'hero_image' => 'assets/images/rabbi_hasan.svg',
            'facebook' => 'https://facebook.com/rabbihasan610',
            'linkedin' => 'https://linkedin.com/in/rabbihasan610',
            'github' => 'https://github.com/rabbihasan610',
            'youtube' => 'https://youtube.com/@rabbihasan610',
            'instagram' => 'https://instagram.com/rabbihasan610',
            'email' => 'mdrabbihasan610@gmail.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    public function test_home_page_loads_with_hero_and_projects(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Md Rabbi Hasan');
        $response->assertSee('assets/images/rabbi_hasan.svg');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About me');
    }

    public function test_experience_page_loads_successfully(): void
    {
        $response = $this->get('/experience');

        $response->assertStatus(200);
        $response->assertSee('Work Experience');
    }

    public function test_projects_catalog_loads_and_filters(): void
    {
        $project = Project::firstOrCreate(
            ['slug' => 'test-portfolio-project'],
            [
                'title' => 'Test Portfolio Project',
                'category' => 'Fintech',
                'technology' => 'Laravel, MySQL',
                'description' => 'Test description',
                'is_published' => true,
            ]
        );

        $response = $this->get('/projects');
        $response->assertStatus(200);
        $response->assertSee('Test Portfolio Project');

        $filteredResponse = $this->get('/projects?category=Fintech');
        $filteredResponse->assertStatus(200);
        $filteredResponse->assertSee('Test Portfolio Project');
    }

    public function test_project_single_case_study_loads(): void
    {
        $project = Project::firstOrCreate(
            ['slug' => 'test-case-study-project'],
            [
                'title' => 'Test Case Study Project',
                'category' => 'High-Traffic',
                'technology' => 'Laravel, Redis',
                'description' => 'A test case study description',
                'problem' => 'Test problem',
                'solution' => 'Test solution',
                'use_case' => 'Test architectural use case',
                'is_published' => true,
            ]
        );

        $response = $this->get('/projects/'.$project->slug);
        $response->assertStatus(200);
        $response->assertSee('Test Case Study Project');
        $response->assertSee('Test problem');
        $response->assertSee('Test solution');
    }

    public function test_blog_listing_and_single_loads(): void
    {
        $post = Post::firstOrCreate(
            ['slug' => 'test-architectural-guide'],
            [
                'title' => 'Test Architectural Guide',
                'category' => 'Architecture',
                'tags' => 'Laravel, Redis',
                'summary' => 'Test blog summary',
                'content' => '<p>Detailed technical content here.</p>',
                'youtube_video_id' => '6kbcZqM4_0M',
                'is_published' => true,
            ]
        );

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Test Architectural Guide');

        $singleResponse = $this->get('/blog/'.$post->slug);
        $singleResponse->assertStatus(200);
        $singleResponse->assertSee('Test Architectural Guide');
        $singleResponse->assertSee('youtube.com/embed/6kbcZqM4_0M');
        $singleResponse->assertSee('Facebook');
        $singleResponse->assertSee('LinkedIn');
        $singleResponse->assertSee('Instagram');
        $singleResponse->assertSee('YouTube');
    }

    public function test_blog_comment_submission(): void
    {
        $post = Post::firstOrCreate(
            ['slug' => 'test-post-for-comment'],
            [
                'title' => 'Test Post For Comment',
                'category' => 'Laravel',
                'content' => 'Content',
                'is_published' => true,
            ]
        );

        $response = $this->post('/blog/'.$post->id.'/comment', [
            'guest_name' => 'Reviewer Name',
            'guest_email' => 'reviewer@example.com',
            'content' => 'Great technical breakdown of this architecture.',
        ]);

        $response->assertSessionHas('comment_success');
        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'guest_name' => 'Reviewer Name',
        ]);
    }

    public function test_cv_page_loads_with_full_details(): void
    {
        ResumeItem::firstOrCreate(
            ['type' => 'experience', 'title' => 'Test Senior Role'],
            [
                'subtitle' => 'Test Company',
                'date_range' => '2023 - 2024',
                'description' => 'Architected APIs',
                'order' => 1,
            ]
        );

        $response = $this->get('/cv');
        $response->assertStatus(200);
        $response->assertSee('Curriculum Vitae');
        $response->assertSee('Download CV (PDF)');
        $response->assertSee('Test Senior Role');
    }

    public function test_dynamic_sitemap_and_robots(): void
    {
        $sitemapResponse = $this->get('/sitemap.xml');
        $sitemapResponse->assertStatus(200);
        $sitemapResponse->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $sitemapResponse->assertSee('<urlset', false);
        $sitemapResponse->assertSee('/projects', false);
        $sitemapResponse->assertSee('/blog', false);

        $robotsResponse = $this->get('/robots.txt');
        $robotsResponse->assertStatus(200);
        $robotsResponse->assertSee('User-agent: *');
        $robotsResponse->assertSee('Sitemap:');
    }

    public function test_newsletter_subscription(): void
    {
        $email = 'subscriber_'.uniqid().'@example.com';
        $response = $this->post('/subscribe', ['email' => $email]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('subscribers', ['email' => $email]);
    }

    public function test_admin_can_access_manage_sections_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/manage-sections');
        $response->assertStatus(200);
        $response->assertSee('Live Portfolio Sections Manager');
        $response->assertSee('Hero &amp; Profile Picture', false);
        $response->assertSee('Key Metrics');
        $response->assertSee('Section Titles');
    }

    public function test_admin_can_update_website_sections_via_livewire(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ManageSections::class)
            ->set('settings.hero_title', 'Updated Master Engineer')
            ->set('settings.hero_subtitle', 'Principal Cloud Architect')
            ->call('save');

        $this->assertDatabaseHas('settings', [
            'key' => 'hero_title',
            'value' => 'Updated Master Engineer',
        ]);

        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Updated Master Engineer');
        $homeResponse->assertSee('Principal Cloud Architect');
    }
}
