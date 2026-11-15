@extends('frontend.layouts.app')

@section('title', 'Projects & Production Architecture | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', 'Explore production systems, high-concurrency ERPs, fintech payment engines, and multi-tenant SaaS platforms engineered by Md Rabbi Hasan.')

@section('content')
  <div style="padding-top: 125px; padding-bottom: 90px;">
    <section class="section" id="projects" style="padding: 0;">
      <div class="container">
        
        {{-- Hero Header --}}
        <div class="reveal" style="text-align: center; max-width: 800px; margin: 0 auto 2rem;">
          <span class="badge-category-pill" style="margin-bottom: 12px; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-code-fork"></i> Production Systems &amp; Case Studies
          </span>
          <h1 style="font-size: clamp(2.1rem, 3.8vw, 3.1rem); font-weight: 800; letter-spacing: -0.03em; color: #ffffff; line-height: 1.2; margin-bottom: 16px;">
            Engineering Case Studies &amp; Architectures
          </h1>
          <p style="color: #94a3b8; font-size: 1.02rem; line-height: 1.68; margin: 0 auto;">
            A curated portfolio of high-concurrency web platforms, fintech ledgers, clinic management suites, and distributed ERPs built for real-world reliability and zero data loss.
          </p>
        </div>

        {{-- Statistics Highlights Strip --}}
        <div class="project-stats-strip reveal">
          <div class="project-stat-chip">
            <i class="fa-solid fa-bolt-lightning"></i>
            <div>
              <strong>High Concurrency</strong>
              <span>5,000+ Req/Sec peak capability</span>
            </div>
          </div>
          <div class="project-stat-chip">
            <i class="fa-solid fa-shield-halved"></i>
            <div>
              <strong>Reliability Focus</strong>
              <span>99.99% Uptime &amp; idempotent APIs</span>
            </div>
          </div>
          <div class="project-stat-chip">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <div>
              <strong>Payment Orchestration</strong>
              <span>bKash, Nagad, Stripe, SSLCommerz</span>
            </div>
          </div>
          <div class="project-stat-chip">
            <i class="fa-solid fa-network-wired"></i>
            <div>
              <strong>Distributed ERPs</strong>
              <span>Multi-branch sync &amp; live ledger</span>
            </div>
          </div>
        </div>

        {{-- Category Filter Navigation --}}
        <div class="filter-nav reveal" style="margin-bottom: 1.8rem;">
          <a href="{{ route('projects', ['search' => $search]) }}" class="filter-tab {{ $activeCategory === 'All' ? 'active' : '' }}">
            All Projects ({{ $projects->count() }})
          </a>
          @foreach($categories as $category)
            <a href="{{ route('projects', ['category' => $category, 'search' => $search]) }}" class="filter-tab {{ $activeCategory === $category ? 'active' : '' }}">
              {{ $category }}
            </a>
          @endforeach
        </div>

        {{-- Search Toolbar --}}
        <div class="reveal" style="max-width: 540px; margin: 0 auto 3.5rem;">
          <form action="{{ route('projects') }}" method="GET" style="display: flex; align-items: center; background: rgba(14, 25, 42, 0.7); padding: 8px 18px; border-radius: 999px; border: 1px solid rgba(148, 178, 211, 0.16); backdrop-filter: blur(8px);">
            @if($activeCategory && $activeCategory !== 'All')
              <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <i class="fa-solid fa-magnifying-glass" style="color: #64748b; margin-right: 12px; font-size: 0.9rem;"></i>
            <input 
              id="case-search" 
              name="search" 
              type="search" 
              value="{{ $search }}" 
              placeholder="Search by system name, tech stack, or problem..." 
              style="border: none; background: transparent; color: #ffffff; outline: none; width: 100%; font-size: 0.9rem;"
            >
            @if($search)
              <a href="{{ route('projects', ['category' => $activeCategory]) }}" style="color: #94a3b8; margin-left: 8px; font-size: 0.85rem;" title="Clear search">
                <i class="fa-solid fa-xmark"></i>
              </a>
            @endif
          </form>

          @if($search)
            <div style="text-align: center; margin-top: 10px;">
              <span style="font-size: 0.78rem; color: #94a3b8; font-family: var(--mono);">
                Searching for: <strong style="color: var(--primary);">"{{ $search }}"</strong>
                <a href="{{ route('projects', ['category' => $activeCategory]) }}" style="margin-left: 6px; color: #ef4444;"><i class="fa-solid fa-xmark"></i> Clear</a>
              </span>
            </div>
          @endif
        </div>

        {{-- Dynamic Projects Grid --}}
        <div class="case-grid" id="case-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 32px;">
          @forelse($projects as $project)
            <article class="project-card-v2 case-card reveal">
              {{-- Card Thumbnail Area --}}
              <div class="project-card-thumb-wrap">
                <a href="{{ route('projects.single', $project->slug) }}" style="display: block; width: 100%; height: 100%;">
                  <img 
                    src="{{ asset($project->image ?? 'assets/images/placeholder.jpg') }}" 
                    alt="{{ $project->title }}" 
                    loading="lazy"
                  >
                </a>
                
                {{-- Left Category Badge --}}
                @if($project->category)
                  <span class="project-badge-left">
                    {{ $project->category }}
                  </span>
                @endif

                {{-- Right Client/Duration Badge --}}
                @if($project->duration || $project->client)
                  <span class="project-badge-right">
                    <i class="fa-regular fa-clock" style="font-size: 0.7rem; color: var(--primary);"></i>
                    {{ $project->duration ?? $project->client }}
                  </span>
                @endif
              </div>

              {{-- Card Body --}}
              <div class="project-card-body-wrap">
                {{-- Role / Purpose Chip --}}
                <div class="project-role-chip">
                  <span class="badge-dot" style="width: 6px; height: 6px;"></span>
                  <span>{{ $project->purpose ?? 'Production Web System' }}</span>
                </div>

                {{-- Project Title --}}
                <h3 class="project-card-heading">
                  <a href="{{ route('projects.single', $project->slug) }}">
                    {{ $project->title }}
                  </a>
                </h3>

                {{-- Project Excerpt / Teaser --}}
                <p class="project-card-excerpt">
                  {{ Str::limit($project->description ?? $project->problem, 130) }}
                </p>

                {{-- Measured Results / Impact Box (if available) --}}
                @if($project->results)
                  <div class="project-impact-box">
                    <i class="fa-solid fa-trophy"></i>
                    <span><strong>Measured Result:</strong> {{ Str::limit($project->results, 100) }}</span>
                  </div>
                @endif

                {{-- Tech Stack Badges --}}
                @if($project->technology)
                  <div class="project-tech-tags">
                    @foreach($project->tech_list as $tech)
                      <span class="project-tech-pill">
                        {{ $tech }}
                      </span>
                    @endforeach
                  </div>
                @endif

                {{-- Action Buttons Row --}}
                <div class="project-card-actions">
                  <a href="{{ route('projects.single', $project->slug) }}" class="button button-primary project-action-primary">
                    Case Study <i class="fa-solid fa-arrow-right"></i>
                  </a>

                  @if($project->url && $project->url !== '#')
                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="project-action-icon-btn" title="Visit Live System">
                      <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                  @endif

                  @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="project-action-icon-btn" title="View Source Code on GitHub">
                      <i class="fa-brands fa-github"></i>
                    </a>
                  @endif
                </div>
              </div>
            </article>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4.5rem 1.5rem; background: rgba(14, 25, 42, 0.4); border: 1px dashed rgba(148, 178, 211, 0.18); border-radius: 18px;">
              <i class="fa-solid fa-folder-open" style="font-size: 2.8rem; color: var(--primary); margin-bottom: 12px;"></i>
              <h3 style="margin-bottom: 8px; color: #ffffff;">No projects found</h3>
              <p style="color: #94a3b8; margin-bottom: 1.5rem; font-size: 0.92rem;">Try adjusting your search criteria or view all projects.</p>
              <a href="{{ route('projects') }}" class="button button-secondary">Reset Filters</a>
            </div>
          @endforelse
        </div>

        {{-- Bottom Collaboration Card --}}
        <div class="reveal" style="margin-top: 5rem; padding: 40px; background: linear-gradient(135deg, rgba(16, 32, 51, 0.8), rgba(8, 18, 31, 0.9)); border: 1px solid rgba(52, 211, 153, 0.22); border-radius: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
          <div>
            <span class="eyebrow" style="margin-bottom: 6px;">Need Architecture Leadership?</span>
            <h3 style="font-size: 1.45rem; font-weight: 700; color: #ffffff; margin: 0 0 6px;">Have a backend system to design or optimize?</h3>
            <p style="color: #94a3b8; font-size: 0.92rem; margin: 0; max-width: 580px;">Available for technical contract roles, high-throughput backend scaling, payment gateway integrations, and API architecture consulting.</p>
          </div>
          <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="{{ route('contact') }}" class="button button-primary">
              Discuss a Project <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a href="{{ route('cv') }}" class="button button-secondary">
              <i class="fa-solid fa-file-lines"></i> View Full CV
            </a>
          </div>
        </div>

      </div>
    </section>
  </div>
@endsection
