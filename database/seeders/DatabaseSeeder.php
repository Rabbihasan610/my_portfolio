<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create / Update Admin User
        User::updateOrCreate(
            ['email' => 'admin@rabbihasan.site'],
            [
                'name' => 'Md Rabbi Hasan',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Comprehensive Dynamic Settings for Every Website Section
        $settings = [
            // Global & SEO Settings
            'site_title' => 'Md Rabbi Hasan | Mid-Level Laravel & PHP Developer',
            'site_tagline' => 'Mid-Level Laravel & PHP Developer | React & API Architect',
            'site_description' => 'Md Rabbi Hasan is a Mid-Level Laravel & PHP Developer from Bangladesh specializing in scalable Laravel backend architectures, REST APIs, SaaS platforms, high-throughput Redis systems, and payment gateway integrations.',
            'site_keywords' => 'Laravel Developer, Mid-Level Backend Developer, PHP Developer, SaaS Architect, REST API, Redis, MySQL, Bangladesh, Md Rabbi Hasan',
            'seo_author' => 'Md Rabbi Hasan',
            'seo_og_image' => 'assets/images/og-cover.jpg',

            // Hero Section Settings
            'hero_title' => 'Md Rabbi Hasan',
            'hero_subtitle' => 'Mid-Level Laravel & PHP Developer',
            'hero_eyebrow' => 'Laravel • PHP • MySQL • Redis • React • REST APIs • Linux VPS',
            'hero_bio' => 'Mid-Level Backend & Full-Stack Developer specializing in enterprise Laravel architectures, high-load payment gateways, SaaS workflows, and automated business platforms.',
            'hero_availability' => 'Available for selected projects',
            'hero_image' => 'assets/images/rabbi_hasan.svg',
            'hero_badge_1_text' => 'API: 99.9% Uptime',
            'hero_badge_2_text' => 'Laravel 13 & PHP 8.3',
            'hero_infra_text' => 'Production Infrastructure: Docker • Nginx • Redis',
            'hero_cta_primary_text' => 'View Projects & Case Studies',
            'hero_cta_secondary_text' => 'View Full CV',
            'hero_cta_contact_text' => 'Contact Me',

            // Metrics / Counters
            'metric_1_number' => '4+',
            'metric_1_label' => 'Years Experience',
            'metric_2_number' => '25+',
            'metric_2_label' => 'Contributed Projects',
            'metric_3_number' => '20+',
            'metric_3_label' => 'API Integrations',
            'metric_4_number' => '99.9%',
            'metric_4_label' => 'Uptime Focus',

            // Services Section Controls
            'services_eyebrow' => 'What I engineer',
            'services_title' => 'Backend expertise that moves products forward.',
            'services_description' => 'From foundational architecture decisions to high-throughput production releases, I build resilient systems your business can confidently scale on.',

            // Projects / Case Studies Controls
            'projects_eyebrow' => 'Selected case studies',
            'projects_title' => 'Systems designed for real-world pressure.',
            'projects_description' => 'A snapshot of backend challenges solved — from transaction-heavy gaming platforms to enterprise ERPs and government portals.',

            // Tech Stack Section Controls
            'stack_eyebrow' => 'Technology stack',
            'stack_title' => 'The right tools for dependable software.',
            'stack_description' => 'A battle-tested backend stack selected for performance, maintainability, and rapid engineering delivery.',

            // Testimonials Section Controls
            'testimonials_eyebrow' => 'Client & Colleague Endorsements',
            'testimonials_title' => 'What engineering leaders say.',
            'testimonials_description' => 'Direct feedback from engineering directors, founders, and team leads who have worked with me.',

            // Blog Section Controls
            'blog_eyebrow' => 'Engineering Blog',
            'blog_title' => 'Technical insights & architecture breakdowns.',
            'blog_description' => 'Thoughts and blueprints on building high-performance Laravel APIs, secure payment systems, and distributed backends.',

            // Call to Action / Contact Controls
            'cta_eyebrow' => 'Ready to collaborate?',
            'cta_title' => 'Let\'s build something exceptional.',
            'cta_description' => 'Whether you need a full SaaS application, API architecture, payment integration, or performance overhaul — I\'m ready to help.',

            // Social Media Profiles
            'facebook' => 'https://www.facebook.com/rabbihasan610',
            'linkedin' => 'https://www.linkedin.com/in/rabbihasan610/',
            'github' => 'https://github.com/rabbihasan610',
            'youtube' => 'https://www.youtube.com/@rabbihasan610',
            'instagram' => 'https://www.instagram.com/md.rabbi.h/',
            'twitter' => 'https://twitter.com/rabbihasan610',

            // Contact & Bio Details
            'email' => 'mdrabbihasan610@gmail.com',
            'phone' => '+880 1684-208275',
            'address' => 'Dhaka, Bangladesh',
            'buy_me_a_coffee' => 'https://buymeacoffee.com/rabbihasan610',
            'cv_download_url' => '/cv/download',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Dynamic Services
        $services = [
            [
                'title' => 'Laravel SaaS Development',
                'description' => 'Multi-tenant architectures, subscription billing, RBAC admin panels, queued jobs, and maintainable domain-driven code.',
                'icon' => 'fa-brands fa-laravel',
                'link' => '/contact',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Payment Gateway Integration',
                'description' => 'Multi-channel checkout, Stripe, bKash, and custom PSP integrations with cryptographically verified idempotent webhooks.',
                'icon' => 'fa-solid fa-credit-card',
                'link' => '/contact',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'High-Traffic & Redis Systems',
                'description' => 'Database indexing, Redis in-memory caching, atomic lock concurrency guards, and sub-50ms API response optimizations.',
                'icon' => 'fa-solid fa-bolt',
                'link' => '/contact',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'AI & Workflow Automation',
                'description' => 'OpenAI and Gemini API integrations, autonomous streaming agents, background prompt orchestration, and intelligent data extraction.',
                'icon' => 'fa-solid fa-brain',
                'link' => '/contact',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'REST API Development',
                'description' => 'Clean, versioned, and documented RESTful APIs designed for SPAs, mobile applications, and third-party partner integrations.',
                'icon' => 'fa-solid fa-code-branch',
                'link' => '/contact',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'VPS / Nginx Optimization',
                'description' => 'Production Linux server management, Nginx reverse proxying, SSL automation, queue supervisors, and zero-downtime deployment pipelines.',
                'icon' => 'fa-solid fa-server',
                'link' => '/contact',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['title' => $srv['title']], $srv);
        }

        // 4. Dynamic Testimonials
        $testimonials = [
            [
                'name' => 'Mhr Habib',
                'position' => 'Senior Engineering Lead',
                'company' => 'Agent To ROI',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Rabbi Hasan has an extraordinary grasp of Laravel architectures and database design. His work optimizing our payment webhooks and background workers eliminated all transaction drops under peak load.',
                'order' => 1,
                'is_published' => true,
            ],
            [
                'name' => 'Ashaduzzaman Faruque',
                'position' => 'Software Engineer',
                'company' => 'Soft Valley',
                'avatar' => null,
                'rating' => 5,
                'content' => 'A truly dependable backend specialist. Rabbi solved complex multi-branch ERP accounting bottlenecks and delivered clean, documented RESTful APIs ahead of schedule.',
                'order' => 2,
                'is_published' => true,
            ],
            [
                'name' => 'Tariqul Islam',
                'position' => 'Product Director',
                'company' => 'Riyadh Online',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Exceptional technical problem solver. From biometric hardware integration to high-concurrency wallet systems, Rabbi always builds robust and scalable software.',
                'order' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t);
        }

        // 5. Dynamic Projects & Comprehensive Case Studies
        $projects = [
            [
                'title' => 'Enterprise Gaming Platform',
                'slug' => 'enterprise-gaming-platform',
                'image' => 'assets/images/tech_ai_dashboard_1790223011738.jpg',
                'category' => 'High-Traffic / SaaS',
                'technology' => 'Laravel, MySQL, Redis, Nginx, Docker',
                'client' => 'Confidential Gaming Operator',
                'duration' => '8 Months',
                'purpose' => 'High-Traffic Real-time Gaming Engine & Wallet Sync',
                'description' => 'A mission-critical backend engine orchestrating real-time wallet synchronization, callback processing from dozens of game providers, and continuous turnover computations under heavy traffic.',
                'problem' => 'The client faced severe transaction drops, race conditions during peak hours, and callback timeouts from game providers causing wallet desynchronization and revenue loss.',
                'solution' => 'Architected a decoupled event-driven processing pipeline using Redis Streams and atomic lock guards. Built idempotent webhook ingestion with retry queues and background turnover calculation workers.',
                'results' => 'Handled 5,000+ requests per second with sub-45ms response time, zero transaction collisions, and 99.99% system availability over 6 consecutive months.',
                'use_case' => "### Architecture & Real-World Flow\n\n1. **Ingestion Layer:** Webhook ingress handled by an ultra-slim Laravel middleware validating HMAC-SHA256 provider signatures.\n2. **Concurrency Control:** Utilized Redis atomic locks (`Cache::lock`) to eliminate concurrent debit/credit race conditions on player balances.\n3. **Event Streaming:** Dispatched game round callbacks to queued workers with delayed backoff algorithms.\n4. **Audit Trail:** Maintained cryptographically tamper-evident logs of every transaction state transition.",
                'features' => "Real-time wallet balance synchronization\nIdempotent game provider callback processing\nAutomated turnover calculations and commission tracking\nMulti-layer Redis caching with automatic invalidation\nAudit logs and transaction forensic analytics",
                'url' => 'https://rabbihasan.site/projects',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Fintech Payment Gateway System',
                'slug' => 'fintech-payment-gateway-system',
                'image' => 'assets/images/ecommerce_b2b_1790222996932.jpg',
                'category' => 'Fintech',
                'technology' => 'Laravel, Stripe, ZapPay, Webhooks, MySQL',
                'client' => 'Fintech Infrastructure Group',
                'duration' => '6 Months',
                'purpose' => 'Multi-Gateway Payment Orchestrator & Ledger System',
                'description' => 'Unified payment orchestration system integrating Stripe, bKash, Nagad, and custom PSP gateways with automated reconciliation and webhook state management.',
                'problem' => 'Multiple disparate payment channels resulted in unhandled webhook drops, duplicate charges, slow reconciliation, and complicated refund dispute workflows.',
                'solution' => 'Engineered an idempotent payment processing pipeline with standardized webhook verification, transaction state machines, automated double-entry ledger bookkeeping, and instant webhook re-dispatch.',
                'results' => 'Eliminated duplicate transactions entirely, cut payment failure rate by 87%, and reduced end-of-month manual reconciliation time from 3 days to under 15 minutes.',
                'use_case' => "### Real-World Use Case\n\n- Supported 50,000+ daily checkout sessions across 4 payment aggregators.\n- Automatic failover: if primary gateway latency exceeded 2000ms, traffic seamlessly redirected to secondary gateway.\n- Comprehensive webhook verification ensuring 100% cryptographic integrity.",
                'features' => "Multi-gateway orchestration with automatic failover\nCryptographically verified idempotent webhooks\nDouble-entry general ledger accounting\nAutomated dispute and refund lifecycle management\nDeveloper API keys with granular IP whitelisting",
                'url' => 'https://rabbihasan.site/projects',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'AI SaaS Workflow Platform',
                'slug' => 'ai-saas-workflow-platform',
                'image' => 'assets/images/corporate_services_1790223023626.jpg',
                'category' => 'AI / SaaS',
                'technology' => 'Laravel, React, OpenAI API, Gemini API, Redis',
                'client' => 'Global SaaS Startup',
                'duration' => '5 Months',
                'purpose' => 'Intelligent Multi-Agent Workflow SaaS',
                'description' => 'A subscription-based SaaS platform enabling businesses to build autonomous AI agent pipelines, ingest knowledge bases, and stream intelligent workflows in real time.',
                'problem' => 'Large language model latency led to timeout issues in standard HTTP requests, and managing per-token credit balances with tiered subscriptions proved fragile.',
                'solution' => 'Implemented streaming responses via Server-Sent Events (SSE), queue-backed token accounting, and a modular prompt orchestration engine connecting OpenAI and Google Gemini APIs.',
                'results' => 'Scaled smoothly to 10,000+ active users with instant streaming tokens, zero SSE dropped frames, and reliable Stripe credit billing.',
                'use_case' => "### Autonomous Workflow Execution\n\nUsers define agent chains where an intake agent analyzes incoming requests, queries a vector knowledge store, generates draft content, and routes human approval steps before dispatching downstream notifications.",
                'features' => "Real-time streaming agent chat via SSE\nMulti-provider LLM failover (OpenAI GPT-4 + Google Gemini)\nToken usage metering and subscription tiers\nOrganization workspaces with role-based member permissions\nWebhooks for third-party integrations (Slack, Zapier)",
                'url' => 'https://rabbihasan.site/projects',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Noorixa ERP & Commercial Operations',
                'slug' => 'noorixa-erp-commercial-operations',
                'image' => 'assets/images/real_estate_platform_1790222978912.jpg',
                'category' => 'ERP / Enterprise',
                'technology' => 'Laravel, MySQL, Alpine.js, Tailwind CSS',
                'client' => 'Commercial Enterprises',
                'duration' => '1 Year',
                'purpose' => 'Enterprise Resource Planning & Multi-Branch Management',
                'description' => 'Comprehensive ERP managing projects, procurement, multi-warehouse inventory, task delegation, CRM, double-entry financial accounting, and print-ready PDF reporting.',
                'problem' => 'Fragmented legacy desktop tools caused stock discrepancies, delayed project accounting, and lack of real-time visibility across branch operations.',
                'solution' => 'Built an integrated web-based ERP with granular role permissions, real-time stock valuation methods (FIFO/WAC), and automated PDF invoices.',
                'results' => 'Connected 12 regional branches with sub-second report generation, reducing inventory shrinkage by 32% and consolidating financial statements in real time.',
                'use_case' => "### Multi-Branch Workflow\n\nBranch staff register customer orders, automatically reserving inventory across regional warehouses. Purchase orders are triggered automatically when stocks dip below configurable re-order thresholds.",
                'features' => "Multi-warehouse inventory management with automated re-orders\nRole-based access control with audit trails\nReal-time financial balance sheet and P&L generation\nPDF & Excel reports generation with custom headers\nTask and milestone tracking with team assignments",
                'url' => 'http://amlaek.com',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => 'Aiyaat Clinic Management Software',
                'slug' => 'aiyaat-clinic-management-software',
                'image' => 'assets/images/healthcare_medical_1790223069063.jpg',
                'category' => 'Healthcare',
                'technology' => 'PHP, Laravel, MySQL, REST API',
                'client' => 'Aiyaat Healthcare Facilities',
                'duration' => '9 Months',
                'purpose' => 'Digital Healthcare Operations & Diagnostic Management',
                'description' => 'Complete clinical operations software managing inpatient (IPD), outpatient (OPD), dynamic pathology laboratory reporting, medical sample collection, doctor commissions, and pharmacy billing.',
                'problem' => 'Handwritten lab reports and disconnected billing led to diagnostic delays, patient wait times exceeding 90 minutes, and billing inconsistencies.',
                'solution' => 'Engineered a unified patient care system with configurable diagnostic report builders, barcode sample tracking, and automated IPD/OPD billing integration.',
                'results' => 'Shortened patient report turnaround time from 2 hours to 20 minutes, serving over 150,000 patient records securely.',
                'use_case' => "### Laboratory Reporting Flow\n\nDoctors order clinical tests; laboratory staff input numeric and text findings into dynamic templates with automatic reference range checking (flagging abnormal values in red). Reports are immediately digitally signed and printable.",
                'features' => "Dynamic pathology and diagnostic test report generator\nBarcode-based sample collection and status tracking\nInpatient (IPD) bed allocation and discharge management\nOutpatient (OPD) queue token management\nAutomated invoicing, doctor fees, and hospital accounting",
                'url' => 'http://aiyaat.com',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'UnionDesk Local Government Smart Portal',
                'slug' => 'uniondesk-local-government-smart-portal',
                'image' => 'assets/images/gov_union_portal_1790223087337.jpg',
                'category' => 'GovTech',
                'technology' => 'PHP, Laravel, MySQL, Vue.js',
                'client' => 'Local Government (Union Parishad)',
                'duration' => '7 Months',
                'purpose' => 'Citizen Digital Service Portal & Holding Tax Automation',
                'description' => 'Digital governance platform enabling citizens to apply online for citizenship certificates, trade licenses, birth registrations, and pay household holding taxes with digital verification.',
                'problem' => 'Citizens had to visit local council offices multiple times for basic certificates, facing paper-based delays and manual cash payment records.',
                'solution' => 'Built a secure citizen portal with QR-code verifiable PDF certificates, mobile SMS notifications, automated tax assessment, and online payment gateway integration.',
                'results' => 'Served 80,000+ rural citizens with 100% verified digital certificates, eliminating fraudulent paperwork and increasing municipal tax recovery by 45%.',
                'use_case' => "### Citizen Application & QR Verification\n\nA citizen applies online using their national ID. The union secretary reviews the request and the chairman digitally signs it. A QR-code encrypted certificate is generated, verifiable by any authority using a mobile camera.",
                'features' => "Instant QR-code verifiable citizen certificates\nHousehold holding-tax assessment and digital receipt generation\nAutomated SMS alerts on application status updates\nAdministrative dashboard for local council chairman and secretaries\nCitizen smart card profile records",
                'url' => 'http://uniondesk.xyz',
                'github_url' => 'https://github.com/rabbihasan610',
                'is_published' => true,
                'is_featured' => false,
                'order' => 6,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(
                ['slug' => $proj['slug']],
                $proj
            );
        }

        // 6. Dynamic Blog Posts
        $posts = [
            [
                'title' => 'Building High-Concurrency Laravel APIs with Redis and Background Queues',
                'slug' => 'building-high-concurrency-laravel-apis-with-redis-and-queues',
                'category' => 'Architecture & Performance',
                'tags' => 'Laravel, Redis, REST API, Queues, MySQL, High Traffic',
                'summary' => 'A comprehensive deep dive into architecting resilient Laravel backends capable of serving thousands of requests per second through smart Redis caching, database connection pooling, and atomic locks.',
                'image' => 'assets/images/tech_ai_dashboard_1790223011738.jpg',
                'youtube_video_id' => '6kbcZqM4_0M',
                'author_name' => 'Md Rabbi Hasan',
                'reading_time' => '7 min read',
                'views_count' => 1420,
                'is_published' => true,
                'is_featured' => true,
                'content' => '
<p class="lead">When scaling backend services to handle thousands of concurrent users, standard database queries quickly become the primary bottleneck. In this guide, we examine production-proven patterns for architecting high-throughput Laravel APIs.</p>

<h2>1. The Problem with Direct Database Reliance</h2>
<p>In standard Laravel controllers, fetching frequently accessed relational models directly from MySQL introduces disk I/O latency and connection starvation. Under high load, connection pools fill up, causing request queuing and cascading 504 gateway timeouts.</p>

<h2>2. Atomic Redis Caching with Tagged Invalidations</h2>
<p>By leveraging Redis with serialization optimization, we can serve repeated requests in sub-5ms while maintaining data freshness through cache tags.</p>

<h2>3. Offloading Work to Horizontal Queue Workers</h2>
<p>Never perform slow I/O (email notifications, webhooks, transaction ledger updates) inside the HTTP request cycle. Dispatch queued jobs to dedicated Redis worker pools configured with supervisor.</p>
',
            ],
            [
                'title' => 'Mastering Payment Gateway Webhooks in Laravel: Idempotency & Security',
                'slug' => 'mastering-payment-gateway-webhooks-in-laravel',
                'category' => 'Fintech & Security',
                'tags' => 'Laravel, Fintech, Payment Gateway, Stripe, Webhooks, Security',
                'summary' => 'How to design bulletproof payment webhook handlers that protect against network retries, duplicate charges, replay attacks, and race conditions.',
                'image' => 'assets/images/ecommerce_b2b_1790222996932.jpg',
                'youtube_video_id' => 'b1n7tM0_K_M',
                'author_name' => 'Md Rabbi Hasan',
                'reading_time' => '6 min read',
                'views_count' => 980,
                'is_published' => true,
                'is_featured' => true,
                'content' => "
<p class=\"lead\">Payment gateways guarantee 'at least once' delivery of webhooks. This means your application WILL receive duplicate events. Without strict idempotency, you risk fulfilling orders twice or issuing duplicate wallet credits.</p>

<h2>1. Cryptographic Signature Verification</h2>
<p>Before parsing any webhook payload, verify the gateway's digital signature against your secret key to prevent spoofing.</p>

<h2>2. The Idempotency Key Pattern</h2>
<p>Store incoming webhook event IDs in an <code>idempotent_events</code> table using a database transaction with a unique constraint.</p>
",
            ],
            [
                'title' => 'Architecting Scalable Multi-Tenant SaaS with Laravel: Shared vs Isolated DB',
                'slug' => 'architecting-scalable-multi-tenant-saas-with-laravel',
                'category' => 'SaaS Architecture',
                'tags' => 'Laravel, SaaS, Multi-Tenancy, Database Design, Scalability',
                'summary' => 'An architectural evaluation of multi-tenant strategies in Laravel: comparing single database with tenant_id against separate database-per-tenant architectures.',
                'image' => 'assets/images/real_estate_platform_1790222978912.jpg',
                'youtube_video_id' => 'uXjH2zKz8_k',
                'author_name' => 'Md Rabbi Hasan',
                'reading_time' => '8 min read',
                'views_count' => 1150,
                'is_published' => true,
                'is_featured' => true,
                'content' => '
<p class="lead">Designing a SaaS platform requires choosing the correct multi-tenancy model early. Changing architecture mid-flight with active enterprise clients is both risky and expensive.</p>

<h2>Option A: Single Database with Global Scopes</h2>
<p>In this model, all tenants share one database schema, with a <code>tenant_id</code> column in every tenant-scoped table.</p>

<h2>Option B: Database-per-Tenant (Isolated)</h2>
<p>Each tenant receives a dedicated database dynamically mounted at runtime based on the requested subdomain or custom domain.</p>
',
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            Comment::firstOrCreate(
                ['post_id' => $post->id, 'guest_email' => 'techlead@example.com'],
                [
                    'guest_name' => 'Tanvir Ahmed',
                    'content' => 'Excellent breakdown of atomic locks in Laravel! We implemented this exact pattern on our payment engine and reduced race conditions to absolute zero.',
                    'is_approved' => true,
                ]
            );

            Comment::firstOrCreate(
                ['post_id' => $post->id, 'guest_email' => 'sofia.dev@example.org'],
                [
                    'guest_name' => 'Sofia Rodriguez',
                    'content' => 'Clear, practical, and production-tested advice. Bookmarking this for our engineering team review.',
                    'is_approved' => true,
                ]
            );
        }

        // 7. Work Experiences
        $experiences = [
            [
                'title' => 'Full-Stack Developer',
                'company' => 'Riyadh Online',
                'duration' => 'Jan 2024 - Present',
                'description' => "• Develop and maintain enterprise Laravel modules across CRM, ERP, union-service, healthcare, accounting, and courier platforms.\n• Successfully integrated ZKTeco hardware devices with application workflows and real-time attendance processing.\n• Built reusable microservices, RESTful APIs, role-based access control, MySQL query optimizations, and print-ready document workflows.\n• Troubleshoot production bottlenecks, maintain data integrity, integrate payment gateways, and manage Linux VPS deployments.",
            ],
            [
                'title' => 'Full-Stack Developer',
                'company' => 'TDevs (Tungi, Gazipur)',
                'duration' => 'Jan 2023 - Dec 2023',
                'description' => "• Delivered client-specific HRM and CodeCanyon SaaS features after auditing architecture, dependencies, and customization boundaries.\n• Designed and implemented payment gateway integrations covering callbacks, webhooks, transaction states, validation, and error handling.\n• Refactored core Laravel modules and MySQL database logic to eliminate performance defects and improve maintainability.",
            ],
            [
                'title' => 'Junior Developer',
                'company' => 'Desktop IT',
                'duration' => 'Jan 2022 - Dec 2022',
                'description' => "• Collaborated with senior engineers to implement and integrate application modules using modern coding standards.\n• Investigated and resolved application and database defects, supporting debugging, unit testing, and release regression testing.\n• Participated in daily technical code reviews and agile delivery standups.",
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['title' => $exp['title'], 'company' => $exp['company']],
                $exp
            );
        }

        // 8. Resume Items
        $resumeItems = [
            [
                'type' => 'experience',
                'title' => 'Full-Stack Developer',
                'subtitle' => 'Riyadh Online | Full-time',
                'date_range' => 'Jan 2024 - Present',
                'description' => 'Architected enterprise Laravel modules for ERP, CRM, healthcare diagnostics, and union services. Integrated ZKTeco biometric hardware, developed high-throughput RESTful APIs, and maintained 99.9% uptime on production Linux VPS servers.',
                'order' => 1,
            ],
            [
                'type' => 'experience',
                'title' => 'Full-Stack Developer',
                'subtitle' => 'TDevs | Full-time',
                'date_range' => 'Jan 2023 - Dec 2023',
                'description' => 'Engineered client-specific HRM and CodeCanyon SaaS products. Implemented automated payment gateway integrations with idempotent webhooks and refactored MySQL database schemas for 40% faster queries.',
                'order' => 2,
            ],
            [
                'type' => 'experience',
                'title' => 'Junior Developer',
                'subtitle' => 'Desktop IT | Full-time',
                'date_range' => 'Jan 2022 - Dec 2022',
                'description' => 'Collaborated on client web modules, performed bug tracking, database schema normalization, and supported regression testing for production web applications.',
                'order' => 3,
            ],
            [
                'type' => 'education',
                'title' => 'BSc in Computer Science & Engineering',
                'subtitle' => 'Northern University Bangladesh',
                'date_range' => 'Running (Enrolled)',
                'description' => 'Undergraduate degree program in Computer Science and Engineering (CSE). Emphasizing advanced software engineering, distributed systems, algorithms, and system design.',
                'order' => 1,
            ],
            [
                'type' => 'education',
                'title' => 'Diploma in Computer Engineering',
                'subtitle' => 'Thakurgaon Polytechnic Institute',
                'date_range' => 'Graduated 2021',
                'description' => 'Achieved CGPA: 3.61 / 4.00. Focus on Computer Science Fundamentals, Data Structures, Algorithms, Database Management Systems, and Software Engineering.',
                'order' => 2,
            ],
            [
                'type' => 'education',
                'title' => 'Secondary School Certificate (SSC)',
                'subtitle' => 'Nouton Bandar Bangheri High School',
                'date_range' => 'Passing Year: 2017',
                'description' => 'Achieved GPA: 4.23 / 5.00 in Science division with strong foundation in mathematics and analytical problem-solving.',
                'order' => 3,
            ],
            [
                'type' => 'training',
                'title' => 'Web Design and Development',
                'subtitle' => 'LEDP (Learning & Earning Development Project) | Offline Government Training',
                'date_range' => '2020',
                'description' => 'Intensive professional training in web standards, responsive design, PHP, and modern frontend development.',
                'order' => 1,
            ],
            [
                'type' => 'training',
                'title' => 'Professional Web Development',
                'subtitle' => 'Creative IT Institute | Offline Advanced Certification',
                'date_range' => '2021',
                'description' => 'Advanced application development covering PHP OOP, Laravel framework, REST APIs, and database architecture.',
                'order' => 2,
            ],
            [
                'type' => 'language',
                'title' => 'Bangla',
                'subtitle' => 'Native / Bilingual',
                'date_range' => null,
                'description' => 'Native language proficiency in speaking, reading, and technical writing.',
                'order' => 1,
            ],
            [
                'type' => 'language',
                'title' => 'English',
                'subtitle' => 'Professional Working Proficiency',
                'date_range' => null,
                'description' => 'Fluent in technical communication, code documentation, client calls, and written architectural specs.',
                'order' => 2,
            ],
            [
                'type' => 'volunteer',
                'title' => 'SEQAEP (Secondary Education Quality and Access Enhancement Project)',
                'subtitle' => 'Volunteer & Community Mentor | Social Work',
                'date_range' => '2016 - 2017',
                'description' => 'Mentored secondary school students in computer literacy, academic tutoring, and community technology awareness.',
                'order' => 1,
            ],
            [
                'type' => 'reference',
                'title' => 'Mhr Habib',
                'subtitle' => 'Senior Engineer at Agent To ROI',
                'date_range' => null,
                'description' => 'Email: info@agenttoroi.com | Phone: +880 1684-208275',
                'order' => 1,
            ],
            [
                'type' => 'reference',
                'title' => 'Ashaduzzaman Faruque',
                'subtitle' => 'Software Engineer at Soft Valley',
                'date_range' => null,
                'description' => 'Email: contact@softvalley.com | Phone: +880 1648-583443',
                'order' => 2,
            ],
            [
                'type' => 'skill',
                'title' => 'Backend & APIs',
                'subtitle' => 'Laravel, PHP 8+, RESTful APIs, MVC Architecture, OOP, Sanctum, Passport',
                'date_range' => 'Expert',
                'description' => 'Building modular, testable, and scalable enterprise backends.',
                'order' => 1,
            ],
            [
                'type' => 'skill',
                'title' => 'Databases & Caching',
                'subtitle' => 'MySQL, Redis, Query Optimization, Database Indexing, Transactions',
                'date_range' => 'Advanced',
                'description' => 'High-performance schema design, index tuning, and in-memory Redis caching.',
                'order' => 2,
            ],
            [
                'type' => 'skill',
                'title' => 'Frontend & UI',
                'subtitle' => 'React, JavaScript (ES6+), Blade, HTML5, CSS3, Tailwind CSS, Bootstrap',
                'date_range' => 'Proficient',
                'description' => 'Modern interactive user interfaces, glassmorphic styling, and responsive design.',
                'order' => 3,
            ],
            [
                'type' => 'skill',
                'title' => 'DevOps & Infrastructure',
                'subtitle' => 'Linux VPS, Nginx, Git, GitHub, Docker, Postman, CI/CD',
                'date_range' => 'Skilled',
                'description' => 'Server provisioning, Nginx configuration, SSL certs, and automated deployments.',
                'order' => 4,
            ],
        ];

        foreach ($resumeItems as $item) {
            ResumeItem::updateOrCreate(
                ['type' => $item['type'], 'title' => $item['title']],
                $item
            );
        }

        // 9. Active CV Record
        Cv::updateOrCreate(
            ['file_path' => 'assets/cv/Md_Rabbi_Hasan_CV.pdf'],
            [
                'version' => '2026.1',
                'is_active' => true,
            ]
        );
    }
}
