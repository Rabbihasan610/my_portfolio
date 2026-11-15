@extends('frontend.layouts.app')

@section('title', 'Professional Experience & Career History | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', 'Commercial software engineering timeline of Md Rabbi Hasan — Full-Stack Developer at Riyadh Online, TDevs, and Desktop IT. Enterprise Laravel, MySQL optimization, and ZKTeco hardware.')
@section('og_title', 'Professional Experience & Career History | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('og_description', 'Commercial software engineering timeline of Md Rabbi Hasan — Full-Stack Developer at Riyadh Online, TDevs, and Desktop IT.')
@section('og_type', 'profile')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Person",
  "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}",
  "jobTitle": "{{ $settings['hero_subtitle'] ?? 'Full-Stack Developer' }}",
  "url": "{{ route('experience') }}",
  "alumniOf": [
    {
      "@@type": "EducationalOrganization",
      "name": "Northern University Bangladesh"
    },
    {
      "@@type": "EducationalOrganization",
      "name": "Thakurgaon Polytechnic Institute"
    }
  ],
  "worksFor": [
    @foreach($experiences as $index => $exp)
    {
      "@@type": "EmployeeRole",
      "roleName": "{{ $exp->title }}",
      "startDate": "{{ $exp->duration }}",
      "employer": {
        "@@type": "Organization",
        "name": "{{ $exp->company }}"
      }
    }{{ $loop->last ? '' : ',' }}
    @endforeach
  ]
}
</script>
@endsection

@section('content')
  <div class="exp-hero-wrap">
    <div class="container">
      {{-- Breadcrumbs Navigation --}}
      <nav class="breadcrumb-trail reveal" aria-label="Breadcrumbs" style="margin-bottom: 24px;">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a>
        <i class="fa-solid fa-chevron-right separator"></i>
        <span class="active">Career & Work Experience</span>
      </nav>

      {{-- Executive Header --}}
      <div class="reveal" style="margin-bottom: 24px;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(52, 211, 153, 0.1); border: 1px solid rgba(52, 211, 153, 0.25); border-radius: 999px; padding: 6px 16px; margin-bottom: 16px;">
          <span class="badge-dot" style="background: var(--primary);"></span>
          <span style="font-family: var(--mono); font-size: 0.78rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.08em;">
            Verified Career Milestones
          </span>
        </div>

        <h1 style="font-size: clamp(2.3rem, 4.4vw, 3.6rem); line-height: 1.15; margin-bottom: 18px; font-weight: 800; letter-spacing: -0.02em;">
          Professional Work Experience
        </h1>

        <p style="font-size: 1.15rem; color: #a4b8cc; line-height: 1.75; max-width: 820px; margin-bottom: 28px;">
          A chronicle of 3+ years architecting enterprise software, scaling high-throughput Laravel backends, integrating hardware telemetry, and delivering mission-critical applications.
        </p>

        <div style="display: flex; gap: 14px; flex-wrap: wrap;">
          @if(isset($activeCv) && $activeCv->file_path)
            <a href="{{ asset($activeCv->file_path) }}" target="_blank" class="button button-primary" download>
              <i class="fa-solid fa-file-arrow-down"></i> Download Official CV (PDF)
            </a>
          @else
            <a href="{{ route('cv') }}" class="button button-primary">
              <i class="fa-solid fa-file-lines"></i> View Detailed CV & Credentials
            </a>
          @endif
          <a href="{{ route('projects') }}" class="button button-secondary">
            <i class="fa-solid fa-layer-group"></i> Production Case Studies
          </a>
          <a href="{{ route('contact') }}" class="button button-secondary">
            <i class="fa-regular fa-envelope"></i> Inquire for Roles / Projects
          </a>
        </div>
      </div>

      {{-- Career Statistics Strip --}}
      <div class="exp-stats-strip reveal">
        <div class="exp-stat-chip">
          <div class="exp-stat-icon-wrap">
            <i class="fa-solid fa-briefcase"></i>
          </div>
          <div>
            <div class="exp-stat-number">3+ Years</div>
            <div class="exp-stat-label">Commercial Experience</div>
          </div>
        </div>
        <div class="exp-stat-chip">
          <div class="exp-stat-icon-wrap" style="color: var(--blue); background: rgba(79, 156, 255, 0.1); border-color: rgba(79, 156, 255, 0.25);">
            <i class="fa-solid fa-server"></i>
          </div>
          <div>
            <div class="exp-stat-number">15+ Modules</div>
            <div class="exp-stat-label">Enterprise Systems</div>
          </div>
        </div>
        <div class="exp-stat-chip">
          <div class="exp-stat-icon-wrap" style="color: #f59e0b; background: rgba(245, 158, 11, 0.1); border-color: rgba(245, 158, 11, 0.25);">
            <i class="fa-solid fa-fingerprint"></i>
          </div>
          <div>
            <div class="exp-stat-number">ZKTeco IoT</div>
            <div class="exp-stat-label">Hardware Integration</div>
          </div>
        </div>
        <div class="exp-stat-chip">
          <div class="exp-stat-icon-wrap" style="color: #a855f7; background: rgba(168, 85, 247, 0.1); border-color: rgba(168, 85, 247, 0.25);">
            <i class="fa-solid fa-shield-halved"></i>
          </div>
          <div>
            <div class="exp-stat-number">99.99%</div>
            <div class="exp-stat-label">Reliability & Uptime</div>
          </div>
        </div>
      </div>

      {{-- Section Separator & Heading --}}
      <div class="reveal" style="margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
        <div>
          <p class="eyebrow" style="margin-bottom: 6px;">Chronological Timeline</p>
          <h2 style="font-size: clamp(1.8rem, 3.2vw, 2.5rem); margin: 0;">Commercial Employment Record</h2>
        </div>
        <span style="font-family: var(--mono); font-size: 0.82rem; color: var(--muted); background: rgba(255, 255, 255, 0.04); padding: 6px 14px; border-radius: 8px; border: 1px solid rgba(148, 178, 211, 0.14);">
          <i class="fa-solid fa-code-commit" style="color: var(--primary); margin-right: 6px;"></i> Verified Track Record
        </span>
      </div>

      {{-- Modern Timeline V2 --}}
      <div class="timeline-v2">
        @foreach($experiences as $exp)
          @php
            $isCurrent = str_contains(strtolower($exp->duration), 'present') || str_contains(strtolower($exp->duration), 'current');
            
            // Generate initials
            $words = preg_split("/[\s,\-]+/", $exp->company);
            $initials = '';
            foreach($words as $w) {
              if(trim($w)) { $initials .= strtoupper($w[0]); }
            }
            $initials = substr($initials, 0, 2) ?: 'EX';

            // Curated tech stack tags per experience
            $tags = match(true) {
              str_contains(strtolower($exp->company), 'riyadh') => ['Laravel 11', 'MySQL Optimization', 'Redis Caching', 'ZKTeco Hardware', 'RESTful APIs', 'Linux VPS', 'RBAC', 'Enterprise ERP'],
              str_contains(strtolower($exp->company), 'tdevs') => ['Laravel SaaS', 'Payment Gateways', 'Idempotent Webhooks', 'HRM Engine', 'CodeCanyon Modules', 'Database Normalization'],
              str_contains(strtolower($exp->company), 'desktop') => ['PHP / Laravel', 'Unit Testing', 'Regression Testing', 'Schema Design', 'Agile Standups', 'Bug Tracking'],
              default => ['Laravel', 'PHP 8.3', 'MySQL', 'REST APIs', 'Git'],
            };
          @endphp
          
          <div class="timeline-v2-item {{ $isCurrent ? 'is-current' : '' }} reveal">
            <div class="timeline-v2-marker">
              @if($isCurrent)
                <i class="fa-solid fa-laptop-code"></i>
              @else
                <i class="fa-solid fa-briefcase"></i>
              @endif
            </div>

            <div class="timeline-v2-card">
              <div class="timeline-v2-header">
                <div class="timeline-v2-company-info">
                  <div class="timeline-v2-avatar">
                    {{ $initials }}
                  </div>
                  <div class="timeline-v2-title-box">
                    <h3>{{ $exp->title }}</h3>
                    <div class="timeline-v2-company-name">
                      <strong><i class="fa-regular fa-building" style="color: var(--primary);"></i> {{ $exp->company }}</strong>
                      <span style="color: var(--line);">•</span>
                      <span>Full-time Position</span>
                    </div>
                  </div>
                </div>

                <div class="timeline-v2-badge-group">
                  <span class="timeline-v2-date">
                    <i class="fa-regular fa-calendar-check"></i> {{ $exp->duration }}
                  </span>
                  @if($isCurrent)
                    <span class="timeline-v2-current-badge">
                      <span class="badge-dot" style="width: 6px; height: 6px; background: #10b981;"></span>
                      Current Active Role
                    </span>
                  @endif
                </div>
              </div>

              {{-- Key Responsibilities / Bullets --}}
              <ul class="timeline-v2-bullets">
                @foreach(explode("\n", $exp->description) as $bullet)
                  @if(trim($bullet))
                    <li class="timeline-v2-bullet">
                      <div class="timeline-v2-bullet-icon">
                        <i class="fa-solid fa-check"></i>
                      </div>
                      <div class="timeline-v2-bullet-text">
                        {{ ltrim(trim($bullet), '• -*') }}
                      </div>
                    </li>
                  @endif
                @endforeach
              </ul>

              {{-- Skills & Technologies Applied --}}
              <div class="timeline-v2-tags">
                @foreach($tags as $t)
                  <span class="timeline-v2-tag">{{ $t }}</span>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Academic & Formal Certifications --}}
      @if((isset($educations) && $educations->isNotEmpty()) || (isset($trainings) && $trainings->isNotEmpty()))
        <div style="margin-top: 5rem;" class="reveal">
          <div class="section-heading" style="text-align: left; margin-bottom: 2rem;">
            <p class="eyebrow">Academic & Formal Certifications</p>
            <h2 style="font-size: clamp(1.8rem, 3.2vw, 2.5rem);">Foundations & Continuous Learning</h2>
            <p>Formal computer engineering background coupled with professional industry certifications.</p>
          </div>

          <div class="edu-card-grid">
            @if(isset($educations) && $educations->isNotEmpty())
              @foreach($educations as $edu)
                <div class="edu-card">
                  <div class="edu-card-top">
                    <div class="edu-card-icon">
                      <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span class="edu-card-date">{{ $edu->date_range ?? 'Completed' }}</span>
                  </div>
                  <h3 class="edu-card-title">{{ $edu->title }}</h3>
                  <div class="edu-card-inst">{{ $edu->subtitle }}</div>
                  <p class="edu-card-desc">{{ $edu->description }}</p>
                </div>
              @endforeach
            @endif

            @if(isset($trainings) && $trainings->isNotEmpty())
              @foreach($trainings as $training)
                <div class="edu-card" style="border-color: rgba(52, 211, 153, 0.2);">
                  <div class="edu-card-top">
                    <div class="edu-card-icon" style="color: var(--primary); background: rgba(52, 211, 153, 0.12); border-color: rgba(52, 211, 153, 0.3);">
                      <i class="fa-solid fa-certificate"></i>
                    </div>
                    <span class="edu-card-date" style="color: var(--primary);">{{ $training->date_range ?? 'Certified' }}</span>
                  </div>
                  <h3 class="edu-card-title">{{ $training->title }}</h3>
                  <div class="edu-card-inst">{{ $training->subtitle }}</div>
                  <p class="edu-card-desc">{{ $training->description }}</p>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      @endif

      {{-- Engineering Specializations --}}
      <div style="margin-top: 5rem;" class="reveal">
        <div class="section-heading" style="text-align: left; margin-bottom: 2rem;">
          <p class="eyebrow">Technical Architecture</p>
          <h2 style="font-size: clamp(1.8rem, 3.2vw, 2.5rem);">Core Engineering Competencies</h2>
          <p>Specialized domains where I add high-impact engineering value.</p>
        </div>

        <div class="competency-grid">
          <div class="competency-card">
            <div class="competency-icon"><i class="fa-solid fa-cubes"></i></div>
            <h4 class="competency-title">Enterprise Laravel Backends</h4>
            <p class="competency-desc">Clean architecture, modular ERP/CRM domains, Service-Repository pattern, REST API versioning, and secure OAuth/Sanctum authentication.</p>
          </div>
          <div class="competency-card">
            <div class="competency-icon" style="color: var(--blue);"><i class="fa-solid fa-database"></i></div>
            <h4 class="competency-title">Database & Cache Optimization</h4>
            <p class="competency-desc">Relational schema design, composite indexes, query tuning, atomic transactions, and in-memory Redis caching for ultra-low latency.</p>
          </div>
          <div class="competency-card">
            <div class="competency-icon" style="color: #f59e0b;"><i class="fa-solid fa-microchip"></i></div>
            <h4 class="competency-title">Hardware & IoT Telemetry</h4>
            <p class="competency-desc">Direct ZKTeco biometric device integration, real-time TCP attendance push listeners, device sync, and hardware error recovery.</p>
          </div>
          <div class="competency-card">
            <div class="competency-icon" style="color: #a855f7;"><i class="fa-solid fa-cloud-arrow-up"></i></div>
            <h4 class="competency-title">Linux & Production Reliability</h4>
            <p class="competency-desc">Ubuntu VPS provisioning, Nginx configuration, SSL orchestration, queue daemon workers (Supervisor), and automated deployment pipelines.</p>
          </div>
        </div>
      </div>

      {{-- Hire / CV Conversion Banner --}}
      <div style="margin-top: 5rem; margin-bottom: 4rem; background: linear-gradient(135deg, rgba(52, 211, 153, 0.08), rgba(79, 156, 255, 0.06)); border: 1px solid rgba(52, 211, 153, 0.25); border-radius: 20px; padding: 40px; text-align: center;" class="reveal">
        <h2 style="font-size: clamp(1.8rem, 3vw, 2.3rem); margin-bottom: 12px;">Looking for a Dependable Backend Engineer?</h2>
        <p style="color: #94a3b8; max-width: 650px; margin: 0 auto 24px; font-size: 1.05rem;">
          Whether you need to scale existing Laravel enterprise systems, optimize database bottlenecks, or build reliable software from scratch, let's talk.
        </p>
        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
          <a href="{{ route('contact') }}" class="button button-primary">
            <i class="fa-regular fa-paper-plane"></i> Get in Touch
          </a>
          <a href="{{ route('cv') }}" class="button button-secondary">
            <i class="fa-solid fa-file-lines"></i> View Complete CV & References
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
