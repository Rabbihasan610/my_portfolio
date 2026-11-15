@extends('frontend.layouts.app')

@section('title', 'Curriculum Vitae (CV) | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', 'Comprehensive Curriculum Vitae of Md Rabbi Hasan — Mid-Level Laravel & PHP Developer. Work experience, education, skills, and certifications.')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ProfilePage",
  "mainEntity": {
    "@@type": "Person",
    "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}",
    "jobTitle": "{{ $settings['hero_subtitle'] ?? 'Mid-Level Laravel & PHP Developer' }}",
    "url": "{{ route('cv') }}",
    "image": "{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}"
  }
}
</script>
@endsection

@section('content')
  <div style="padding-top: 130px; padding-bottom: 80px;">
    <section class="section cv-section" id="cv" style="padding: 0;">
      <div class="container">
        
        {{-- Profile Header Card --}}
        <div class="cv-header-card reveal">
          <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
            <div style="width: 100px; height: 100px; border-radius: 24px; overflow: hidden; border: 2px solid var(--primary); background: #081320; flex-shrink: 0;">
              <img src="{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}" alt="{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div>
              <p class="eyebrow" style="margin-bottom: 4px;">Curriculum Vitae</p>
              <h1 style="font-size: clamp(1.8rem, 3.5vw, 2.6rem); margin-bottom: 6px;">
                {{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}
              </h1>
              <p style="color: var(--primary); font-weight: 700; font-size: 1.05rem; margin-bottom: 8px;">
                {{ $settings['hero_subtitle'] ?? 'Mid-Level Laravel & PHP Developer' }}
              </p>
              <div style="display: flex; gap: 16px; flex-wrap: wrap; color: var(--muted); font-size: 0.85rem;">
                <span><i class="fa-solid fa-location-dot" style="color: var(--primary);"></i> {{ $settings['address'] ?? 'Dhaka, Bangladesh' }}</span>
                <span><i class="fa-solid fa-envelope" style="color: var(--primary);"></i> {{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}</span>
                <span><i class="fa-solid fa-phone" style="color: var(--primary);"></i> {{ $settings['phone'] ?? '+880 1684-208275' }}</span>
              </div>
            </div>
          </div>

          {{-- Action Buttons --}}
          <div style="display: flex; gap: 10px; flex-wrap: wrap;" class="no-print">
            <a href="{{ route('cv.download') }}" class="button button-primary" title="Download CV PDF">
              <i class="fa-solid fa-download"></i> Download CV (PDF)
            </a>
            <button onclick="window.print()" class="button button-secondary" title="Print or Save as PDF">
              <i class="fa-solid fa-print"></i> Print CV
            </button>
            <a href="{{ route('contact') }}" class="button button-secondary">
              <i class="fa-regular fa-paper-plane"></i> Hire Me
            </a>
          </div>
        </div>

        {{-- Professional Summary Box --}}
        <div class="case-block reveal" style="margin-bottom: 30px;">
          <h2><i class="fa-solid fa-user-tie" style="color: var(--primary);"></i> Professional Summary</h2>
          <p style="font-size: 1.05rem; line-height: 1.8; color: #a4b8cc; margin: 0;">
            Mid-Level Laravel & PHP Developer with dedicated hands-on production engineering experience designing and building scalable SaaS platforms, high-throughput REST APIs, multi-branch ERP systems, and automated payment gateways. Specialized in MySQL optimization, Redis caching layers, microservices, and queue pipelines. Proven track record in translating complex business specifications into clean, resilient software architectures.
          </p>
        </div>

        {{-- Technical Skills Matrix --}}
        @if($skills->isNotEmpty())
          <div class="case-block reveal" style="margin-bottom: 30px;">
            <h2><i class="fa-solid fa-laptop-code" style="color: var(--blue);"></i> Technical Core Competencies</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-top: 18px;">
              @foreach($skills as $skill)
                <div style="padding: 18px; background: rgba(255,255,255,0.02); border: 1px solid var(--line); border-radius: 12px;">
                  <strong style="display: block; color: var(--primary); font-size: 0.95rem; margin-bottom: 6px;">
                    {{ $skill->title }}
                  </strong>
                  <p style="font-size: 0.88rem; color: #9ab1c7; margin-bottom: 8px;">
                    {{ $skill->subtitle }}
                  </p>
                  <small style="color: var(--muted); font-size: 0.78rem;">
                    Level: {{ $skill->date_range ?? 'Advanced' }}
                  </small>
                </div>
              @endforeach
            </div>
          </div>
        @endif

        {{-- CV Columns: Experience, Education, Training, Languages, References --}}
        <div class="cv-grid">
          {{-- Left Column: Work Experience & Education --}}
          <div class="cv-column reveal">
            @if($experiences->isNotEmpty())
              <h3><i class="fa-solid fa-briefcase"></i> Work Experience</h3>
              @foreach($experiences as $exp)
                <div class="cv-item">
                  <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 6px;">
                    <h4>{{ $exp->title }}</h4>
                    <span style="color: var(--primary); font-size: 0.8rem; font-weight: 700;">{{ $exp->date_range }}</span>
                  </div>
                  <p style="color: var(--text); font-weight: 600; font-size: 0.9rem; margin-bottom: 6px;">
                    {{ $exp->subtitle }}
                  </p>
                  @if($exp->description)
                    <p style="margin-top: 0.5rem; font-size: 0.86rem; color: #9ab1c7; line-height: 1.6;">
                      {{ $exp->description }}
                    </p>
                  @endif
                </div>
              @endforeach
            @endif

            @if($educations->isNotEmpty())
              <h3 style="margin-top: 30px;"><i class="fa-solid fa-graduation-cap"></i> Education</h3>
              @foreach($educations as $edu)
                <div class="cv-item">
                  <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 6px;">
                    <h4>{{ $edu->title }}</h4>
                    <span style="color: var(--primary); font-size: 0.8rem; font-weight: 700;">{{ $edu->date_range }}</span>
                  </div>
                  <p style="color: var(--text); font-weight: 600; font-size: 0.88rem;">{{ $edu->subtitle }}</p>
                  @if($edu->description)
                    <p style="margin-top: 0.4rem; font-size: 0.85rem; color: var(--muted);">{{ $edu->description }}</p>
                  @endif
                </div>
              @endforeach
            @endif
          </div>

          {{-- Right Column: Training, Languages, Volunteers, References --}}
          <div class="cv-column reveal">
            @if($trainings->isNotEmpty())
              <h3><i class="fa-solid fa-certificate"></i> Certifications & Training</h3>
              @foreach($trainings as $tr)
                <div class="cv-item">
                  <h4>{{ $tr->title }}</h4>
                  <p style="color: var(--text); font-weight: 600; font-size: 0.88rem;">{{ $tr->subtitle }}</p>
                  @if($tr->description)
                    <p style="margin-top: 0.4rem; font-size: 0.85rem; color: var(--muted);">{{ $tr->description }}</p>
                  @endif
                </div>
              @endforeach
            @endif

            @if($languages->isNotEmpty())
              <h3 style="margin-top: 30px;"><i class="fa-solid fa-language"></i> Languages</h3>
              <div class="cv-item">
                @foreach($languages as $lang)
                  <p style="margin-bottom: 8px;">
                    <strong style="color: var(--text);">{{ $lang->title }}:</strong> 
                    <span style="color: var(--muted);">{{ $lang->subtitle }}</span>
                  </p>
                @endforeach
              </div>
            @endif

            @if($volunteers->isNotEmpty())
              <h3 style="margin-top: 30px;"><i class="fa-solid fa-hands-holding-circle"></i> Volunteer Experience</h3>
              @foreach($volunteers as $vol)
                <div class="cv-item">
                  <h4>{{ $vol->title }}</h4>
                  <p style="color: var(--text); font-weight: 600; font-size: 0.88rem;">{{ $vol->subtitle }}</p>
                  @if($vol->description)
                    <p style="margin-top: 0.4rem; font-size: 0.85rem; color: var(--muted);">{{ $vol->description }}</p>
                  @endif
                </div>
              @endforeach
            @endif

            @if($references->isNotEmpty())
              <h3 style="margin-top: 30px;"><i class="fa-solid fa-user-check"></i> Professional References</h3>
              @foreach($references as $ref)
                <div class="cv-item">
                  <h4>{{ $ref->title }}</h4>
                  <p style="color: var(--primary); font-weight: 600; font-size: 0.88rem;">{{ $ref->subtitle }}</p>
                  @if($ref->description)
                    <p style="margin-top: 0.4rem; font-size: 0.85rem; color: var(--muted);">{{ $ref->description }}</p>
                  @endif
                </div>
              @endforeach
            @endif
          </div>
        </div>

      </div>
    </section>
  </div>
@endsection
