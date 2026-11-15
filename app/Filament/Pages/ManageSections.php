<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\WithFileUploads;
use UnitEnum;

class ManageSections extends Page
{
    use WithFileUploads;

    protected static ?string $navigationLabel = 'Manage Sections';

    protected static ?string $title = 'Website Sections Control Center';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAdjustmentsHorizontal;

    protected static string|UnitEnum|null $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-sections';

    public string $activeTab = 'hero';

    /**
     * @var array<string, mixed>
     */
    public array $settings = [];

    public $hero_image_file = null;

    public $seo_og_image_file = null;

    public function mount(): void
    {
        $existing = Setting::pluck('value', 'key')->toArray();

        $defaults = [
            // Hero section
            'hero_title' => 'Md Rabbi Hasan',
            'hero_subtitle' => 'Senior Laravel & PHP Developer',
            'hero_eyebrow' => 'Laravel • PHP • MySQL • Redis • React • REST APIs • Linux',
            'hero_bio' => 'Backend & Full-Stack Developer specializing in enterprise Laravel architectures, payment gateway integrations, SaaS applications, and automated business workflows.',
            'hero_availability' => 'Available for selected projects',
            'hero_image' => 'assets/images/rabbi_hasan.svg',
            'hero_badge_1_text' => 'API: 99.9% Uptime',
            'hero_badge_2_text' => 'Laravel 13 & PHP 8.3',
            'hero_infra_text' => 'Production Infrastructure: Docker • Nginx • Redis',
            'hero_cta_primary_text' => 'View Projects & Case Studies',
            'hero_cta_secondary_text' => 'View Full CV',
            'hero_cta_contact_text' => 'Contact Me',

            // Metrics
            'metric_1_number' => '4+',
            'metric_1_label' => 'Years Experience',
            'metric_2_number' => '25+',
            'metric_2_label' => 'Contributed Projects',
            'metric_3_number' => '20+',
            'metric_3_label' => 'API Integrations',
            'metric_4_number' => '99.9%',
            'metric_4_label' => 'Uptime Focus',

            // Section headings
            'services_eyebrow' => 'What I engineer',
            'services_title' => 'Backend expertise that moves products forward.',
            'services_description' => 'From foundational architecture decisions to high-throughput production releases, I build resilient systems your business can confidently scale on.',

            'projects_eyebrow' => 'Selected case studies',
            'projects_title' => 'Systems designed for real-world pressure.',
            'projects_description' => 'A snapshot of backend challenges solved — from transaction-heavy gaming platforms to enterprise ERPs and government portals.',

            'stack_eyebrow' => 'Technology stack',
            'stack_title' => 'Tools chosen for performance, stability, and scale.',
            'stack_description' => 'I avoid hype and select battle-tested software built to process hundreds of requests per second reliably.',

            'testimonials_eyebrow' => 'Endorsements',
            'testimonials_title' => 'Trusted by product owners, CTOs, and founders.',
            'testimonials_description' => 'Real feedback from leaders and clients whose missions depended on zero-downtime execution.',

            'blog_eyebrow' => 'Technical writing',
            'blog_title' => 'Architecture insights, production lessons, and workflows.',
            'blog_description' => 'Field notes on scaling Laravel applications, debugging bottlenecks, and designing mission-critical web APIs.',

            'cta_eyebrow' => 'Ready to build?',
            'cta_title' => "Let's engineer a solution that scales seamlessly.",
            'cta_description' => 'Available for high-impact backend contracts, architecture consultations, payment integrations, and dedicated engineering roles.',
            'cta_primary_text' => 'Start a Conversation',
            'cta_secondary_text' => 'Download Full CV (PDF)',

            // Social channels
            'facebook' => 'https://facebook.com/rabbihasan.dev',
            'youtube' => 'https://youtube.com/@rabbihasan-dev',
            'instagram' => 'https://instagram.com/rabbihasan.dev',
            'linkedin' => 'https://linkedin.com/in/rabbihasan-dev',
            'github' => 'https://github.com/rabbihasan-dev',
            'twitter' => 'https://twitter.com/rabbihasan_dev',
            'buy_me_a_coffee' => 'https://buymeacoffee.com/rabbihasan',

            // Contact
            'email' => 'rabbi.hasan.dev@gmail.com',
            'phone' => '+880 1700 000000',
            'address' => 'Dhaka, Bangladesh',

            // SEO
            'site_title' => 'Md Rabbi Hasan | Senior Laravel & PHP Developer',
            'site_tagline' => 'Enterprise Laravel Backend, Microservices, REST APIs & SaaS Architectures',
            'site_description' => 'Official portfolio and case studies of Md Rabbi Hasan, a Senior Laravel & PHP Developer specializing in enterprise backends, payment gateways, REST APIs, and high-performance SaaS applications.',
            'site_keywords' => 'Md Rabbi Hasan, Laravel Developer, Senior PHP Developer, Full-Stack Developer, Laravel Architect, REST APIs, Microservices, Redis, MySQL, Bangladesh Software Engineer',
            'seo_author' => 'Md Rabbi Hasan',
            'seo_og_image' => 'assets/images/rabbi_hasan.svg',
        ];

        $this->settings = array_merge($defaults, $existing);
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function save(): void
    {
        if ($this->hero_image_file) {
            $path = $this->hero_image_file->store('profile', 'public');
            $this->settings['hero_image'] = 'storage/'.$path;
            $this->hero_image_file = null;
        }

        if ($this->seo_og_image_file) {
            $path = $this->seo_og_image_file->store('seo', 'public');
            $this->settings['seo_og_image'] = 'storage/'.$path;
            $this->seo_og_image_file = null;
        }

        foreach ($this->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_string($value) ? trim($value) : $value]
            );
        }

        Notification::make()
            ->title('Website Sections & Settings Updated!')
            ->body('All changes are now live on your portfolio frontend.')
            ->success()
            ->send();
    }
}
