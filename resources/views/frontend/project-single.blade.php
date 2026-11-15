@extends('frontend.layouts.app')

@section('title', $project->title . ' | Project Case Study | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', Str::limit($project->description ?? $project->problem, 160))
@section('og_title', $project->title . ' — Case Study & Use Case')
@section('og_description', Str::limit($project->description ?? $project->problem, 160))
@section('og_image', asset($project->image ?? 'assets/images/og-cover.jpg'))
@section('og_type', 'article')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "SoftwareApplication",
  "name": "{{ $project->title }}",
  "applicationCategory": "{{ $project->category ?? 'BusinessApplication' }}",
  "operatingSystem": "Web",
  "description": "{{ addslashes(Str::limit($project->description ?? $project->problem, 200)) }}",
  "author": {
    "@@type": "Person",
    "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}"
  },
  "url": "{{ route('projects.single', $project->slug) }}",
  "image": "{{ asset($project->image ?? 'assets/images/placeholder.jpg') }}"
}
</script>
@endsection

@section('content')
  <article class="case-study-hero">
    <div class="container">
      {{-- Breadcrumbs Navigation --}}
      <nav class="breadcrumb-trail reveal" aria-label="Breadcrumbs" style="margin-bottom: 24px;">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a>
        <i class="fa-solid fa-chevron-right separator"></i>
        <a href="{{ route('projects') }}">Projects & Case Studies</a>
        <i class="fa-solid fa-chevron-right separator"></i>
        <span class="active">{{ Str::limit($project->title, 35) }}</span>
      </nav>

      {{-- Header & Title --}}
      <div class="reveal">
        <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-bottom: 16px;">
          <span style="background: rgba(84, 224, 181, 0.12); color: var(--primary); border: 1px solid rgba(84, 224, 181, 0.3); font-size: 0.75rem; font-weight: 800; font-family: var(--mono); padding: 5px 14px; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.05em;">
            <i class="fa-solid fa-layer-group" style="margin-right: 5px;"></i> {{ $project->category ?? 'Laravel System' }}
          </span>
          <span style="color: var(--muted); font-size: 0.88rem; font-family: var(--mono);">
            <i class="fa-solid fa-bullseye" style="color: var(--blue); margin-right: 4px;"></i> {{ $project->purpose ?? 'Production Case Study' }}
          </span>
        </div>

        <h1 style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); line-height: 1.18; margin-bottom: 20px; font-weight: 800; letter-spacing: -0.02em;">
          {{ $project->title }}
        </h1>

        <p style="font-size: 1.15rem; color: #a4b8cc; line-height: 1.75; max-width: 880px; margin-bottom: 24px;">
          {{ $project->description }}
        </p>
      </div>

      {{-- Metadata Grid --}}
      <div class="case-meta-grid reveal">
        <div class="case-meta-item">
          <small><i class="fa-regular fa-building" style="margin-right: 4px;"></i> Client / Industry</small>
          <strong>{{ $project->client ?? 'Commercial Enterprise' }}</strong>
        </div>
        <div class="case-meta-item">
          <small><i class="fa-regular fa-calendar-check" style="margin-right: 4px;"></i> Timeline / Duration</small>
          <strong>{{ $project->duration ?? '3-6 Months' }}</strong>
        </div>
        <div class="case-meta-item">
          <small><i class="fa-solid fa-code" style="margin-right: 4px;"></i> Engineering Role</small>
          <strong>Lead Backend / Full-Stack</strong>
        </div>
        <div class="case-meta-item">
          <small><i class="fa-solid fa-microchip" style="margin-right: 4px;"></i> Primary Tech</small>
          <strong style="font-family: var(--mono); font-size: 0.92rem;">{{ $project->technology ?? 'Laravel, MySQL, Redis' }}</strong>
        </div>
      </div>

      {{-- Action Buttons --}}
      <div style="display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 34px;" class="reveal">
        @if($project->url && $project->url !== '#')
          <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="button button-primary">
            Visit Live Application <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </a>
        @endif
        @if($project->github_url)
          <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="button button-secondary">
            <i class="fa-brands fa-github"></i> Repository / Profile
          </a>
        @endif
        <a href="{{ route('contact') }}" class="button button-secondary">
          <i class="fa-regular fa-envelope"></i> Inquire About Similar Architecture
        </a>
      </div>

      {{-- Case Study Banner Showcase --}}
      @if($project->image)
        <div class="case-study-banner reveal">
          <img src="{{ asset($project->image) }}" alt="{{ $project->title }} Preview">
        </div>
      @endif

      {{-- Main Case Study Body Grid --}}
      <div class="case-body-grid">
        {{-- Left Column: Detailed Problem, Solution, Architecture & Use Case --}}
        <div class="case-main-column">
          {{-- Challenge / Problem --}}
          @if($project->problem)
            <div class="case-block reveal">
              <h2><i class="fa-solid fa-triangle-exclamation" style="color: #f59e0b;"></i> The Challenge & Pain Point</h2>
              <p>{{ $project->problem }}</p>
            </div>
          @endif

          {{-- Architectural Solution --}}
          @if($project->solution)
            <div class="case-block reveal">
              <h2><i class="fa-solid fa-lightbulb" style="color: var(--primary);"></i> Architectural Solution</h2>
              <p>{{ $project->solution }}</p>
            </div>
          @endif

          {{-- Deep-Dive Use Case & Engineering Architecture --}}
          @if($project->use_case)
            <div class="case-block reveal">
              <h2><i class="fa-solid fa-diagram-project" style="color: var(--blue);"></i> System Architecture & Real-World Use Case</h2>
              <div style="color: #a4b8cc; line-height: 1.8; font-size: 1rem;">
                {!! nl2br(e($project->use_case)) !!}
              </div>
            </div>
          @endif

          {{-- Measurable Results & Impact --}}
          @if($project->results)
            <div class="case-block reveal" style="border-color: rgba(84, 224, 181, 0.4); background: linear-gradient(145deg, rgba(16, 32, 51, 0.95), rgba(6, 13, 24, 0.95));">
              <h2><i class="fa-solid fa-chart-line" style="color: #10b981;"></i> Measured Results & Business Impact</h2>
              <p style="font-size: 1.08rem; color: #e2e8f0; font-weight: 500;">
                {{ $project->results }}
              </p>
            </div>
          @endif
        </div>

        {{-- Right Column: Tech Stack & Feature Checklist --}}
        <div class="case-sidebar-column">
          {{-- Key Technical Features --}}
          @if($project->features)
            <div class="case-block reveal" style="padding: 24px;">
              <h3 style="font-size: 1.15rem; margin-bottom: 16px;">
                <i class="fa-solid fa-list-check" style="color: var(--primary);"></i> Key Features
              </h3>
              <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                @foreach(explode("\n", $project->features) as $feature)
                  @if(trim($feature))
                    <li style="display: flex; gap: 10px; font-size: 0.9rem; color: #9ab1c7;">
                      <i class="fa-solid fa-check" style="color: var(--primary); margin-top: 4px; flex-shrink: 0;"></i>
                      <span>{{ trim($feature) }}</span>
                    </li>
                  @endif
                @endforeach
              </ul>
            </div>
          @endif

          {{-- Technology Stack Pills --}}
          @if($project->technology)
            <div class="case-block reveal" style="padding: 24px;">
              <h3 style="font-size: 1.15rem; margin-bottom: 16px;">
                <i class="fa-solid fa-layer-group" style="color: var(--blue);"></i> Technologies Used
              </h3>
              <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                @foreach($project->tech_list as $tech)
                  <span class="skill-tag-pill" style="border-color: rgba(84, 224, 181, 0.25);">
                    {{ $tech }}
                  </span>
                @endforeach
              </div>
            </div>
          @endif

          {{-- Consultation Card --}}
          <div class="case-block reveal" style="padding: 24px; text-align: center; background: linear-gradient(135deg, rgba(84, 224, 181, 0.08), rgba(79, 156, 255, 0.04));">
            <h3 style="font-size: 1.1rem; justify-content: center;">Need a Similar System?</h3>
            <p style="font-size: 0.88rem; color: var(--muted); margin-bottom: 18px;">
              I can help architect and build a dependable solution tailored to your product requirements.
            </p>
            <a href="{{ route('contact') }}" class="button button-primary" style="width: 100%; min-height: 44px; font-size: 0.84rem;">
              Schedule a Discussion <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>

      {{-- More Case Studies Navigation --}}
      @if($relatedProjects->isNotEmpty())
        <div style="margin-top: 5rem; border-top: 1px solid var(--line); padding-top: 3rem;" class="reveal">
          <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
              <p class="eyebrow" style="margin-bottom: 6px;">Next Case Studies</p>
              <h2>Explore other production systems</h2>
            </div>
            <a href="{{ route('projects') }}" class="button button-secondary">
              View All Projects <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>

          <div class="case-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 26px;">
            @foreach($relatedProjects as $related)
              <article class="project-card-v2 case-card">
                <div class="project-card-thumb-wrap" style="height: 190px;">
                  <a href="{{ route('projects.single', $related->slug) }}" style="display: block; width: 100%; height: 100%;">
                    <img src="{{ asset($related->image ?? 'assets/images/placeholder.jpg') }}" alt="{{ $related->title }}" loading="lazy">
                  </a>
                  @if($related->category)
                    <span class="project-badge-left">{{ $related->category }}</span>
                  @endif
                  @if($related->duration)
                    <span class="project-badge-right">
                      <i class="fa-regular fa-clock" style="font-size: 0.7rem; color: var(--primary);"></i> {{ $related->duration }}
                    </span>
                  @endif
                </div>
                <div class="project-card-body-wrap">
                  <div class="project-role-chip">
                    <span class="badge-dot" style="width: 6px; height: 6px;"></span>
                    <span>{{ $related->purpose ?? 'Production System' }}</span>
                  </div>
                  <h3 class="project-card-heading">
                    <a href="{{ route('projects.single', $related->slug) }}">{{ $related->title }}</a>
                  </h3>
                  <p class="project-card-excerpt">
                    {{ Str::limit($related->description ?? $related->problem, 110) }}
                  </p>
                  <div class="project-card-actions" style="margin-top: auto; padding-top: 14px;">
                    <a href="{{ route('projects.single', $related->slug) }}" class="button button-primary project-action-primary" style="font-size: 0.82rem; min-height: 40px; width: 100%;">
                      Read Case Study <i class="fa-solid fa-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </article>
@endsection
