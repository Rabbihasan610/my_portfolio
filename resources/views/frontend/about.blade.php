@extends('frontend.layouts.app')

@section('title', 'About Rabbi Hasan | Mid-Level Laravel & PHP Developer')
@section('description', 'Learn more about Md Rabbi Hasan — background, engineering philosophy, production experience, and core backend competencies.')

@section('content')
  <div style="padding-top: 130px; padding-bottom: 80px;">
    <section class="section about-section" id="about" style="padding: 0;">
      <div class="container about-grid">
        <div class="about-visual reveal">
          <div class="terminal">
            <div class="terminal-bar"><span></span><span></span><span></span><small>rabbi@production:~</small></div>
            <div class="terminal-body">
              <p><b>$</b> php artisan about</p>
              <p class="muted">Environment ........... production</p>
              <p class="muted">Laravel ............... 13.x (optimized)</p>
              <p class="muted">PHP ................... 8.3 (opcache enabled)</p>
              <p class="muted">Cache ................. redis (cluster)</p>
              <p class="muted">Queue ................. supervisor active</p>
              <p><b>$</b> deploy --zero-downtime</p>
              <p class="success">✓ Automated health check passed (99.9% uptime)</p>
              <p><b>$</b> <span class="terminal-cursor"></span></p>
            </div>
          </div>
          <div class="experience-card">
            <strong>Production</strong>
            <span>is where dependable backend architecture proves itself.</span>
          </div>
        </div>

        <div class="about-content reveal">
          <p class="eyebrow">About me</p>
          <h1 style="font-size: clamp(2.2rem, 3.8vw, 3.2rem); margin-bottom: 1.5rem;">
            {{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }} — 
            <span>{{ $settings['hero_subtitle'] ?? 'Mid-Level Laravel & PHP Developer' }}</span>
          </h1>

          <p style="font-size: 1.05rem; line-height: 1.8; color: #c0d3e5; margin-bottom: 1rem;">
            I am a Mid-Level Laravel & PHP Developer based in Bangladesh with dedicated engineering experience building scalable backend platforms, high-throughput REST APIs, multi-branch ERP software, and mission-critical payment pipelines.
          </p>

          <p style="font-size: 1.05rem; line-height: 1.8; color: #c0d3e5; margin-bottom: 1.5rem;">
            My technical focus centers on backend resiliency — ensuring database queries are index-optimized, background queues never starve, and payment webhooks are strictly idempotent. I work comfortably with Laravel, PHP 8+, MySQL, Redis, React, and Linux VPS environments.
          </p>

          <div class="about-points" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin: 2rem 0;">
            <div style="padding: 16px; background: var(--card); border: 1px solid var(--line); border-radius: 12px;">
              <strong style="display: block; color: var(--primary); font-size: 1.1rem; margin-bottom: 4px;">4+ Years</strong>
              <small style="color: var(--muted);">Engineering Production Code</small>
            </div>
            <div style="padding: 16px; background: var(--card); border: 1px solid var(--line); border-radius: 12px;">
              <strong style="display: block; color: var(--primary); font-size: 1.1rem; margin-bottom: 4px;">25+ Projects</strong>
              <small style="color: var(--muted);">Websites, SaaS & Portals</small>
            </div>
            <div style="padding: 16px; background: var(--card); border: 1px solid var(--line); border-radius: 12px;">
              <strong style="display: block; color: var(--primary); font-size: 1.1rem; margin-bottom: 4px;">Sub-50ms</strong>
              <small style="color: var(--muted);">API Response Optimization</small>
            </div>
          </div>

          <div style="display: flex; gap: 14px; flex-wrap: wrap;">
            <a href="{{ route('cv') }}" class="button button-primary">
              <i class="fa-solid fa-file-lines"></i> View Detailed CV
            </a>
            <a href="{{ route('contact') }}" class="button button-secondary">
              <i class="fa-regular fa-envelope"></i> Let's Connect
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
