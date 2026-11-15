@extends('frontend.layouts.app')

@section('title', ($settings['site_title'] ?? 'Md Rabbi Hasan | Mid-Level Laravel & PHP Developer'))
@section('description', ($settings['site_description'] ?? 'Mid-Level Laravel & PHP Developer specializing in enterprise backends, REST APIs, SaaS platforms, and payment integrations.'))

@section('content')
  {{-- Hero Section --}}
  <section class="hero section" id="home">
    <div class="hero-grid-bg" aria-hidden="true"></div>
    <div class="hero-orb orb-one" aria-hidden="true"></div>
    <div class="hero-orb orb-two" aria-hidden="true"></div>

    <div class="container hero-layout">
      {{-- Left Column: Copy & Actions --}}
      <div class="hero-content reveal">
        <div class="availability">
          <span class="pulse-indicator"></span> {{ $settings['hero_availability'] ?? 'Available for selected projects' }}
        </div>
        
        @if(!empty($settings['hero_eyebrow']))
          <p class="hero-tech-eyebrow">{{ $settings['hero_eyebrow'] }}</p>
        @endif
        
        <div class="hero-title-group">
          <h1 class="hero-title">{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}</h1>
          <p class="hero-subtitle">
            <span>{{ $settings['hero_subtitle'] ?? 'Mid-Level Laravel & PHP Developer' }}</span>
          </p>
        </div>
        
        <p class="hero-copy">
          {{ $settings['hero_bio'] ?? 'Backend & Full-Stack Developer specializing in enterprise Laravel architectures, payment gateway integrations, SaaS applications, and automated business workflows.' }}
        </p>

        <div class="hero-actions">
          <a class="button button-primary" href="{{ route('projects') }}">
            {{ $settings['hero_cta_primary_text'] ?? 'View Projects & Case Studies' }} <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a class="button button-secondary" href="{{ route('cv') }}">
            <i class="fa-solid fa-file-lines"></i> {{ $settings['hero_cta_secondary_text'] ?? 'View Full CV' }}
          </a>
          <a class="button button-secondary" href="{{ route('contact') }}">
            <i class="fa-regular fa-envelope"></i> {{ $settings['hero_cta_contact_text'] ?? 'Contact Me' }}
          </a>
        </div>

        {{-- Social channels quick bar --}}
        <div class="social-channel-bar">
          @if(!empty($settings['github']))
            <a href="{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-github" title="GitHub">
              <i class="fa-brands fa-github"></i> <span>GitHub</span>
            </a>
          @endif
          @if(!empty($settings['linkedin']))
            <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-linkedin" title="LinkedIn">
              <i class="fa-brands fa-linkedin"></i> <span>LinkedIn</span>
            </a>
          @endif
          @if(!empty($settings['facebook']))
            <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-facebook" title="Facebook">
              <i class="fa-brands fa-facebook"></i> <span>Facebook</span>
            </a>
          @endif
          @if(!empty($settings['youtube']))
            <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-youtube" title="YouTube">
              <i class="fa-brands fa-youtube"></i> <span>YouTube</span>
            </a>
          @endif
          @if(!empty($settings['instagram']))
            <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-instagram" title="Instagram">
              <i class="fa-brands fa-instagram"></i> <span>Instagram</span>
            </a>
          @endif
        </div>
      </div>

      {{-- Right Column: Developer Portrait / Hero Picture & Floating Badges --}}
      <div class="hero-visual-card reveal" aria-label="Md Rabbi Hasan Professional Developer Portrait">
        <div class="hero-avatar-wrapper">
          {{-- Floating Badge Top Left --}}
          <div class="floating-badge badge-top-left">
            <span class="badge-dot"></span>
            <span>{{ $settings['hero_badge_1_text'] ?? 'API: 99.9% Uptime' }}</span>
          </div>

          {{-- Portrait Picture --}}
          <div class="hero-avatar-inner">
            <img 
              src="{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}" 
              alt="{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}" 
              class="hero-avatar-img"
              loading="eager"
            >
          </div>

          {{-- Floating Badge Bottom Right --}}
          <div class="floating-badge badge-bottom-right">
            <i class="fa-brands fa-laravel" style="color: #ff2d20; font-size: 1rem;"></i>
            <span>{{ $settings['hero_badge_2_text'] ?? 'Laravel 13 & PHP 8.3' }}</span>
          </div>
        </div>

        {{-- Mini Architecture Status Chip --}}
        <div class="hero-infra-chip">
          <i class="fa-solid fa-server"></i>
          <span>{{ $settings['hero_infra_text'] ?? 'Production Infrastructure: Docker • Nginx • Redis' }}</span>
        </div>
      </div>
    </div>
  </section>

  {{-- Metrics Section with Animated Count-up --}}
  <section class="metrics" aria-label="Professional metrics" style="border-block: 1px solid rgba(148, 178, 211, 0.1); background: rgba(7, 13, 24, 0.5); padding: 40px 0;">
    <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
      <div class="metric reveal" style="padding: 24px; background: rgba(14, 25, 42, 0.6); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 16px; text-align: center; border-right: none;">
        <strong style="font-family: var(--mono); font-size: 2.2rem; font-weight: 700; color: #ffffff; letter-spacing: -0.02em; display: block;" data-count="{{ preg_replace('/[^0-9.]/', '', $settings['metric_1_number'] ?? '4') }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $settings['metric_1_number'] ?? '+') }}">
          {{ $settings['metric_1_number'] ?? '4+' }}
        </strong>
        <span style="display: block; margin-top: 6px; color: #94a3b8; font-size: 0.74rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--mono);">
          {{ $settings['metric_1_label'] ?? 'Years Experience' }}
        </span>
      </div>
      <div class="metric reveal" style="padding: 24px; background: rgba(14, 25, 42, 0.6); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 16px; text-align: center; border-right: none;">
        <strong style="font-family: var(--mono); font-size: 2.2rem; font-weight: 700; color: #ffffff; letter-spacing: -0.02em; display: block;" data-count="{{ preg_replace('/[^0-9.]/', '', $settings['metric_2_number'] ?? '25') }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $settings['metric_2_number'] ?? '+') }}">
          {{ $settings['metric_2_number'] ?? '25+' }}
        </strong>
        <span style="display: block; margin-top: 6px; color: #94a3b8; font-size: 0.74rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--mono);">
          {{ $settings['metric_2_label'] ?? 'Contributed Projects' }}
        </span>
      </div>
      <div class="metric reveal" style="padding: 24px; background: rgba(14, 25, 42, 0.6); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 16px; text-align: center; border-right: none;">
        <strong style="font-family: var(--mono); font-size: 2.2rem; font-weight: 700; color: #ffffff; letter-spacing: -0.02em; display: block;" data-count="{{ preg_replace('/[^0-9.]/', '', $settings['metric_3_number'] ?? '20') }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $settings['metric_3_number'] ?? '+') }}">
          {{ $settings['metric_3_number'] ?? '20+' }}
        </strong>
        <span style="display: block; margin-top: 6px; color: #94a3b8; font-size: 0.74rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--mono);">
          {{ $settings['metric_3_label'] ?? 'API Integrations' }}
        </span>
      </div>
      <div class="metric reveal" style="padding: 24px; background: rgba(14, 25, 42, 0.6); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 16px; text-align: center; border-right: none;">
        <strong style="font-family: var(--mono); font-size: 2.2rem; font-weight: 700; color: #ffffff; letter-spacing: -0.02em; display: block;" data-count="{{ preg_replace('/[^0-9.]/', '', $settings['metric_4_number'] ?? '99.9') }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $settings['metric_4_number'] ?? '%') }}">
          {{ $settings['metric_4_number'] ?? '99.9%' }}
        </strong>
        <span style="display: block; margin-top: 6px; color: #94a3b8; font-size: 0.74rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--mono);">
          {{ $settings['metric_4_label'] ?? 'Uptime Focus' }}
        </span>
      </div>
    </div>
  </section>

  {{-- Services / Core Specialization Section (Dynamically Loaded from Services Table) --}}
  <section class="section" id="services">
    <div class="container">
      <div class="section-heading reveal">
        <div>
          <p class="eyebrow">{{ $settings['services_eyebrow'] ?? 'What I engineer' }}</p>
          <h2>{{ $settings['services_title'] ?? 'Backend expertise that moves products forward.' }}</h2>
        </div>
        <p>{{ $settings['services_description'] ?? 'From foundational architecture decisions to high-throughput production releases, I build resilient systems your business can confidently scale on.' }}</p>
      </div>

      <div class="services-grid" id="services-grid">
        @forelse($services as $index => $service)
          <article class="service-card reveal" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
              <div class="icon-box" style="margin-bottom: 0;"><i class="{{ $service->icon }}"></i></div>
              <span style="font-family: var(--mono); font-size: 0.72rem; color: #64748b; font-weight: 700;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <h3 style="font-size: 1.22rem; font-weight: 700; color: #ffffff; margin-bottom: 10px; letter-spacing: -0.02em;">{{ $service->title }}</h3>
            <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.65; margin-bottom: 20px;">{{ $service->description }}</p>
            <a href="{{ $service->link ?? route('contact') }}" style="margin-top: auto;">Discuss a project <i class="fa-solid fa-arrow-right"></i></a>
          </article>
        @empty
          <article class="service-card reveal" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
              <div class="icon-box" style="margin-bottom: 0;"><i class="fa-brands fa-laravel"></i></div>
              <span style="font-family: var(--mono); font-size: 0.72rem; color: #64748b; font-weight: 700;">01</span>
            </div>
            <h3 style="font-size: 1.22rem; font-weight: 700; color: #ffffff; margin-bottom: 10px; letter-spacing: -0.02em;">Laravel SaaS Development</h3>
            <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.65; margin-bottom: 20px;">Multi-tenant architectures, subscription billing, and RBAC admin panels.</p>
            <a href="{{ route('contact') }}" style="margin-top: auto;">Discuss a project <i class="fa-solid fa-arrow-right"></i></a>
          </article>
        @endforelse
      </div>
    </div>
  </section>

  {{-- Selected Dynamic Case Studies Section --}}
  <section class="section" id="work" style="background: rgba(255,255,255,0.01);">
    <div class="container">
      <div class="section-heading reveal">
        <div>
          <p class="eyebrow">{{ $settings['projects_eyebrow'] ?? 'Selected case studies' }}</p>
          <h2>{{ $settings['projects_title'] ?? 'Systems designed for real-world pressure.' }}</h2>
        </div>
        <p>{{ $settings['projects_description'] ?? 'A snapshot of backend challenges solved — from transaction-heavy gaming platforms to enterprise ERPs and government portals.' }}</p>
      </div>

      <div class="case-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 30px;">
        @foreach($featuredProjects as $index => $project)
          <article class="case-card reveal project-card" style="border-radius: 18px; overflow: hidden; background: rgba(14, 25, 42, 0.65); border: 1px solid rgba(148, 178, 211, 0.12); display: flex; flex-direction: column;">
            <div class="project-image" style="height: 210px; position: relative; overflow: hidden; background: #081320;">
              <a href="{{ route('projects.single', $project->slug) }}">
                <img 
                  src="{{ asset($project->image ?? 'assets/images/placeholder.jpg') }}" 
                  alt="{{ $project->title }}" 
                  loading="lazy"
                  style="width: 100%; height: 100%; object-fit: cover;"
                >
              </a>
              @if($project->category)
                <span style="position: absolute; top: 12px; left: 12px; background: rgba(7, 13, 24, 0.88); backdrop-filter: blur(8px); color: var(--primary); font-size: 0.7rem; font-weight: 700; font-family: var(--mono); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(52, 211, 153, 0.25); text-transform: uppercase;">
                  {{ $project->category }}
                </span>
              @endif
            </div>

            <div class="project-content" style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
              <div class="case-top" style="margin-bottom: 8px;">
                <span class="case-type" style="color: #94a3b8; font-size: 0.78rem; font-family: var(--mono);">
                  {{ $project->purpose ?? 'Web Application' }}
                </span>
              </div>

              <h3 style="font-size: 1.25rem; font-weight: 700; line-height: 1.35; margin-bottom: 12px; letter-spacing: -0.02em;">
                <a href="{{ route('projects.single', $project->slug) }}" style="color: #ffffff;">
                  {{ $project->title }}
                </a>
              </h3>

              <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.65; margin-bottom: 18px;">
                {{ Str::limit($project->description ?? $project->problem, 125) }}
              </p>

              @if($project->technology)
                <div class="tags" style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 22px;">
                  @foreach($project->tech_list as $tech)
                    <span style="font-size: 0.72rem; padding: 2px 8px; background: rgba(255,255,255,0.04); border-radius: 4px; border: 1px solid rgba(148, 178, 211, 0.12); color: #cbd5e1; font-family: var(--mono);">
                      {{ $tech }}
                    </span>
                  @endforeach
                </div>
              @endif

              <div style="display: flex; gap: 10px; margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(148, 178, 211, 0.12);">
                <a href="{{ route('projects.single', $project->slug) }}" class="button button-primary" style="flex: 1; min-height: 38px; font-size: 0.8rem;">
                  Case Study <i class="fa-solid fa-arrow-right"></i>
                </a>
                @if($project->url && $project->url !== '#')
                  <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="button button-secondary" style="min-height: 38px; padding: 0 14px;" title="Live Preview">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                @endif
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div style="text-align: center; margin-top: 3.5rem;" class="reveal">
        <a class="button button-secondary" href="{{ route('projects') }}">
          View All Projects &amp; Architecture <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  {{-- Tech Stack Interactive Showcase --}}
  <section class="section stack-section" id="stack">
    <div class="container">
      <div class="center-heading reveal" style="text-align: center; max-width: 720px; margin: 0 auto 3rem;">
        <p class="eyebrow">{{ $settings['stack_eyebrow'] ?? 'Technology stack' }}</p>
        <h2>{{ $settings['stack_title'] ?? 'The right tools for dependable software.' }}</h2>
        <p>{{ $settings['stack_description'] ?? 'A battle-tested backend stack selected for performance, maintainability, and rapid engineering delivery.' }}</p>
      </div>

      <div class="stack-grid reveal" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(135px, 1fr)); gap: 16px; text-align: center;">
        <div class="stack-card-item">
          <i class="fa-brands fa-laravel" style="font-size: 2.2rem; color: #ff2d20;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">Laravel</strong></div>
          <span class="stack-role-badge">Framework</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-brands fa-php" style="font-size: 2.2rem; color: #8892be;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">PHP 8.3</strong></div>
          <span class="stack-role-badge">Backend Engine</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-solid fa-database" style="font-size: 2.2rem; color: #00758f;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">MySQL</strong></div>
          <span class="stack-role-badge">Relational DB</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-solid fa-bolt" style="font-size: 2.2rem; color: #dc382d;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">Redis</strong></div>
          <span class="stack-role-badge">In-Memory Cache</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-brands fa-react" style="font-size: 2.2rem; color: #61dafb;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">React</strong></div>
          <span class="stack-role-badge">Frontend UI</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-brands fa-docker" style="font-size: 2.2rem; color: #2496ed;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">Docker</strong></div>
          <span class="stack-role-badge">Containers</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-solid fa-server" style="font-size: 2.2rem; color: #009639;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">Nginx</strong></div>
          <span class="stack-role-badge">Web Server</span>
        </div>
        <div class="stack-card-item">
          <i class="fa-brands fa-git-alt" style="font-size: 2.2rem; color: #f05032;"></i>
          <div><strong style="color: #ffffff; font-size: 0.95rem;">Git &amp; CI/CD</strong></div>
          <span class="stack-role-badge">DevOps Workflow</span>
        </div>
      </div>
    </div>
  </section>

  {{-- Testimonials Section (Dynamically Loaded from Testimonials Table) --}}
  @if($testimonials->isNotEmpty())
    <section class="section" id="testimonials" style="background: rgba(255,255,255,0.015); border-block: 1px solid rgba(148, 178, 211, 0.1);">
      <div class="container">
        <div class="section-heading reveal">
          <div>
            <p class="eyebrow">{{ $settings['testimonials_eyebrow'] ?? 'Client & Colleague Endorsements' }}</p>
            <h2>{{ $settings['testimonials_title'] ?? 'What engineering leaders say.' }}</h2>
          </div>
          <p>{{ $settings['testimonials_description'] ?? 'Real feedback from engineering directors, founders, and team leads who have worked with me.' }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
          @foreach($testimonials as $t)
            <div class="reveal" style="display: flex; flex-direction: column; padding: 28px; background: rgba(14, 25, 42, 0.65); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 18px; position: relative;">
              <div style="color: #f59e0b; margin-bottom: 14px; font-size: 0.88rem; display: flex; gap: 4px;">
                @for($i = 0; $i < $t->rating; $i++)
                  <i class="fa-solid fa-star"></i>
                @endfor
              </div>
              <p style="color: #cbd5e1; font-size: 0.94rem; line-height: 1.7; font-style: italic; margin-bottom: 22px;">
                "{{ $t->content }}"
              </p>
              <div style="margin-top: auto; display: flex; align-items: center; gap: 14px; padding-top: 16px; border-top: 1px solid rgba(148, 178, 211, 0.12);">
                <div style="width: 42px; height: 42px; border-radius: 50%; background: rgba(52, 211, 153, 0.12); border: 1.5px solid var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--primary); font-size: 0.9rem;">
                  {{ strtoupper(substr($t->name, 0, 2)) }}
                </div>
                <div>
                  <strong style="color: #ffffff; font-size: 0.92rem; display: block;">{{ $t->name }}</strong>
                  <small style="color: #94a3b8; font-size: 0.78rem;">{{ $t->position }} @ {{ $t->company }}</small>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- Latest Technical Insights & Blog Posts --}}
  @if($recentPosts->isNotEmpty())
    <section class="section" id="blog" style="background: rgba(255,255,255,0.01);">
      <div class="container">
        <div class="section-heading reveal">
          <div>
            <p class="eyebrow">{{ $settings['blog_eyebrow'] ?? 'Engineering Blog' }}</p>
            <h2>{{ $settings['blog_title'] ?? 'Technical insights & architecture breakdowns.' }}</h2>
          </div>
          <p>{{ $settings['blog_description'] ?? 'Thoughts and blueprints on building high-performance Laravel APIs, secure payment systems, and distributed backends.' }}</p>
        </div>

        <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
          @foreach($recentPosts as $post)
            <article class="blog-card reveal">
              @if($post->image)
                <div class="blog-card-thumbnail">
                  <a href="{{ route('blog.single', $post->slug) }}">
                    <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" loading="lazy">
                  </a>
                  @if($post->category)
                    <span style="position: absolute; top: 12px; left: 12px; background: rgba(7, 13, 24, 0.88); backdrop-filter: blur(8px); color: var(--primary); font-size: 0.7rem; font-weight: 700; font-family: var(--mono); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(52, 211, 153, 0.25); text-transform: uppercase;">
                      {{ $post->category }}
                    </span>
                  @endif
                </div>
              @endif

              <div class="blog-card-body">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 0.76rem; color: #94a3b8; font-family: var(--mono);">
                  <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
                  <span><i class="fa-regular fa-clock"></i> {{ $post->reading_time ?? '5 min read' }}</span>
                </div>

                <h3 class="blog-card-title">
                  <a href="{{ route('blog.single', $post->slug) }}">
                    {{ $post->title }}
                  </a>
                </h3>

                <p class="blog-card-summary">
                  {{ $post->summary ?? Str::limit(strip_tags($post->content), 120) }}
                </p>

                <div style="margin-top: auto; padding-top: 14px; border-top: 1px solid rgba(148, 178, 211, 0.12); display: flex; justify-content: space-between; align-items: center;">
                  <span style="font-size: 0.76rem; color: #64748b; font-family: var(--mono);">
                    {{ $post->created_at->format('M d, Y') }}
                  </span>
                  <a href="{{ route('blog.single', $post->slug) }}" style="color: var(--primary); font-weight: 700; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 5px;">
                    Read Article <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div style="text-align: center; margin-top: 3.2rem;" class="reveal">
          <a class="button button-secondary" href="{{ route('blog') }}">
            Browse All Blog Articles <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </section>
  @endif

  {{-- Contact & Project Inquiry CTA --}}
  <section class="section" id="contact" style="padding-top: 70px; padding-bottom: 70px;">
    <div class="container">
      <div class="reveal" style="background: linear-gradient(135deg, rgba(16, 32, 51, 0.95), rgba(8, 18, 31, 0.95)); border: 1px solid rgba(52, 211, 153, 0.28); border-radius: 24px; padding: 48px; text-align: center; max-width: 880px; margin: 0 auto; box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);">
        <p class="eyebrow" style="margin-bottom: 10px;">{{ $settings['cta_eyebrow'] ?? 'Ready to collaborate?' }}</p>
        <h2 style="font-size: clamp(1.9rem, 3.4vw, 2.75rem); font-weight: 800; color: #ffffff; letter-spacing: -0.03em; margin-bottom: 16px;">
          {{ $settings['cta_title'] ?? 'Let\'s build something exceptional.' }}
        </h2>
        <p style="max-width: 580px; margin: 0 auto 26px; color: #94a3b8; font-size: 1rem; line-height: 1.65;">
          {{ $settings['cta_description'] ?? 'Whether you need a full SaaS application, API architecture, payment integration, or performance overhaul — I\'m ready to help.' }}
        </p>

        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; align-items: center;">
          <a class="button button-primary" href="{{ route('contact') }}">
            Send a Project Brief <i class="fa-solid fa-arrow-right"></i>
          </a>
          <a class="button button-secondary" href="mailto:{{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}">
            <i class="fa-regular fa-envelope"></i> {{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection
