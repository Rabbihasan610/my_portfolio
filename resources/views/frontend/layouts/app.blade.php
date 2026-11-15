<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#060d18">
  
  {{-- Dynamic SEO Meta Tags --}}
  <title>@yield('title', $settings['site_title'] ?? 'Md Rabbi Hasan | Senior Laravel & PHP Developer')</title>
  <meta name="description" content="@yield('description', $settings['site_description'] ?? 'Md Rabbi Hasan is a Senior Laravel & PHP Developer from Bangladesh specializing in scalable Laravel backend architectures, REST APIs, SaaS platforms, and payment integrations.')">
  <meta name="keywords" content="@yield('keywords', $settings['site_keywords'] ?? 'Laravel Developer, Senior Backend Developer, PHP Developer, SaaS Architect, REST API, Redis, MySQL, Bangladesh')">
  <meta name="author" content="{{ $settings['seo_author'] ?? 'Md Rabbi Hasan' }}">
  <link rel="canonical" href="@yield('canonical', url()->current())" />

  {{-- Open Graph / Facebook / LinkedIn --}}
  <meta property="og:site_name" content="Md Rabbi Hasan Portfolio">
  <meta property="og:title" content="@yield('og_title', $title ?? ($settings['site_title'] ?? 'Md Rabbi Hasan | Senior Laravel & PHP Developer'))">
  <meta property="og:description" content="@yield('og_description', $description ?? ($settings['site_description'] ?? 'Senior Laravel & PHP Developer specializing in enterprise backends, REST APIs, and SaaS systems.'))">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:url" content="@yield('canonical', url()->current())">
  <meta property="og:image" content="@yield('og_image', asset($settings['seo_og_image'] ?? 'assets/images/og-cover.jpg'))">

  {{-- Twitter Cards --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="@yield('og_title', $title ?? ($settings['site_title'] ?? 'Md Rabbi Hasan | Senior Laravel & PHP Developer'))">
  <meta name="twitter:description" content="@yield('og_description', $description ?? ($settings['site_description'] ?? 'Senior Laravel & PHP Developer specializing in enterprise backends, REST APIs, and SaaS systems.'))">
  <meta name="twitter:image" content="@yield('og_image', asset($settings['seo_og_image'] ?? 'assets/images/og-cover.jpg'))">

  {{-- Google Fonts & Icons --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  
  {{-- Application Stylesheet --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  {{-- Global Structured Data (JSON-LD) for Full SEO --}}
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@graph": [
      {
        "@@type": "Person",
        "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}",
        "jobTitle": "{{ $settings['hero_subtitle'] ?? 'Senior Laravel & PHP Developer' }}",
        "url": "{{ url('/') }}",
        "image": "{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}",
        "email": "mailto:{{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}",
        "telephone": "{{ $settings['phone'] ?? '+880 1684-208275' }}",
        "address": {
          "@@type": "PostalAddress",
          "addressLocality": "Dhaka",
          "addressCountry": "Bangladesh"
        },
        "sameAs": [
          "{{ $settings['facebook'] ?? 'https://www.facebook.com/rabbihasan610' }}",
          "{{ $settings['linkedin'] ?? 'https://www.linkedin.com/in/rabbihasan610/' }}",
          "{{ $settings['github'] ?? 'https://github.com/rabbihasan610' }}",
          "{{ $settings['youtube'] ?? 'https://www.youtube.com/@rabbihasan610' }}",
          "{{ $settings['instagram'] ?? 'https://www.instagram.com/md.rabbi.h/' }}"
        ],
        "knowsAbout": [
          "Laravel", "PHP 8.3", "REST APIs", "MySQL", "Redis", 
          "SaaS Development", "Payment Gateways", "Stripe", "React", "Docker", "Linux VPS"
        ]
      },
      {
        "@@type": "WebSite",
        "url": "{{ url('/') }}",
        "name": "{{ $settings['site_title'] ?? 'Md Rabbi Hasan | Senior Laravel & PHP Developer' }}",
        "description": "{{ $settings['site_description'] ?? 'Official portfolio of Md Rabbi Hasan, Senior Laravel & PHP Developer' }}",
        "publisher": {
          "@@type": "Person",
          "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}"
        }
      }
    ]
  }
  </script>

  @yield('schema')
  @stack('styles')
</head>
<body>
  {{-- Mouse tracking glow effect --}}
  <div class="cursor-glow" aria-hidden="true"></div>

  {{-- Global Header --}}
  <header class="site-header" id="top">
    <nav class="navbar container" aria-label="Main navigation">
      <a class="logo" href="{{ route('home') }}" aria-label="Md Rabbi Hasan home">
        <span class="logo-mark">RH</span>
        <span>{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}</span>
      </a>
      
      <button class="nav-toggle" type="button" aria-label="Open navigation" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>

      <div class="nav-links">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('experience') }}" class="{{ request()->routeIs('experience') ? 'active' : '' }}">Experience</a>
        <a href="{{ route('projects') }}" class="{{ request()->routeIs('projects*') ? 'active' : '' }}">Projects</a>
        <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('cv') }}" class="{{ request()->routeIs('cv*') ? 'active' : '' }}">CV</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        <a class="nav-cta" href="mailto:{{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}">
          Let's Talk <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
      </div>
    </nav>
  </header>

  {{-- Notification Alerts --}}
  @if(session('success'))
    <div class="container" style="padding-top: 100px;">
      <div class="app-alert alert-success">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('info'))
    <div class="container" style="padding-top: 100px;">
      <div class="app-alert alert-info">
        <i class="fa-solid fa-circle-info"></i>
        <span>{{ session('info') }}</span>
      </div>
    </div>
  @endif

  {{-- Main Content --}}
  <main>
    @yield('content')
  </main>

  {{-- Global Footer --}}
  <footer>
    <div class="container footer-inner" style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 2rem; padding: 4.5rem 0;">
      
      <div style="display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
        <a class="logo" href="{{ route('home') }}">
          <span class="logo-mark">RH</span>
          <span>{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}</span>
        </a>
        <p style="color: var(--muted); font-size: 0.95rem;">
          {{ $settings['hero_subtitle'] ?? 'Senior Laravel & PHP Developer' }}
        </p>
      </div>

      <div class="footer-links" style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('experience') }}">Experience</a>
        <a href="{{ route('projects') }}">Projects</a>
        <a href="{{ route('blog') }}">Blog</a>
        <a href="{{ route('cv') }}">CV</a>
        <a href="{{ route('contact') }}">Contact</a>
        <a href="{{ route('sitemap') }}" target="_blank">Sitemap</a>
      </div>
      
      {{-- Newsletter Subscription --}}
      <div class="footer-subscribe" style="width: 100%; max-width: 520px; padding: 2rem; background: var(--card); border: 1px solid var(--line); border-radius: 16px;">
        <h4 style="margin-bottom: 0.5rem; color: var(--primary); font-size: 1.1rem;">Subscribe to Technical Updates</h4>
        <p style="margin-bottom: 1.5rem; font-size: 0.88rem; color: var(--muted);">In-depth insights on Laravel, high-traffic systems, and modern backend architecture.</p>
        <form action="{{ route('subscribe') }}" method="POST" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
          @csrf
          <input type="email" name="email" placeholder="Enter your email address" required style="flex: 1; min-width: 220px; padding: 0.8rem 1.2rem; border-radius: 8px; border: 1px solid var(--line); background: var(--card-solid); color: var(--text); outline: none;">
          <button type="submit" class="button button-primary" style="padding: 0.8rem 1.6rem; cursor: pointer;">
            Subscribe
          </button>
        </form>
      </div>

      {{-- Buy Me a Coffee Support --}}
      @if(!empty($settings['buy_me_a_coffee']))
        <div class="footer-coffee">
          <a href="{{ $settings['buy_me_a_coffee'] }}" target="_blank" rel="noopener noreferrer" class="button button-secondary" style="font-size: 0.85rem; padding: 0.6rem 1.2rem; display: inline-flex; align-items: center; gap: 0.6rem;">
            <i class="fa-solid fa-mug-hot" style="color: #ffdd00;"></i> Support My Work (Buy Me a Coffee)
          </a>
        </div>
      @endif
    
      {{-- Social Media Icons (Facebook, YouTube, Instagram, LinkedIn, GitHub) --}}
      <div class="social-channel-bar" style="justify-content: center; gap: 14px;">
        @if(!empty($settings['github']))
          <a href="{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-github" aria-label="GitHub">
            <i class="fa-brands fa-github"></i> <span>GitHub</span>
          </a>
        @endif
        @if(!empty($settings['linkedin']))
          <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-linkedin" aria-label="LinkedIn">
            <i class="fa-brands fa-linkedin"></i> <span>LinkedIn</span>
          </a>
        @endif
        @if(!empty($settings['facebook']))
          <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-facebook" aria-label="Facebook">
            <i class="fa-brands fa-facebook"></i> <span>Facebook</span>
          </a>
        @endif
        @if(!empty($settings['youtube']))
          <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-youtube" aria-label="YouTube">
            <i class="fa-brands fa-youtube"></i> <span>YouTube</span>
          </a>
        @endif
        @if(!empty($settings['instagram']))
          <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-instagram" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i> <span>Instagram</span>
          </a>
        @endif
      </div>
      
      <p style="color: var(--muted); font-size: 0.85rem; margin-top: 1rem;">
        © <span id="year">{{ date('Y') }}</span> {{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}. All rights reserved.
      </p>
    </div>
  </footer>

  {{-- Scripts --}}
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
