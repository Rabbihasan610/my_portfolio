@extends('frontend.layouts.app')

@section('title', 'Contact Rabbi Hasan | Mid-Level Laravel & PHP Developer')
@section('description', 'Get in touch with Md Rabbi Hasan for Laravel SaaS development, API architectures, payment gateway integrations, and consulting.')

@section('content')
  <div style="padding-top: 130px; padding-bottom: 80px;">
    <section class="section contact-section" id="contact" style="padding: 0;">
      <div class="container contact-grid">
        {{-- Left Info Column --}}
        <div class="contact-copy reveal">
          <p class="eyebrow">Get in touch</p>
          <h1 style="font-size: clamp(2.2rem, 4vw, 3.2rem); margin-bottom: 0.5rem;">
            Let's Start a Conversation.
          </h1>
          <p style="font-size: 1.1rem; color: var(--primary); font-weight: 700; margin-bottom: 1rem;">
            {{ $settings['hero_subtitle'] ?? 'Mid-Level Laravel & PHP Developer' }}
          </p>
          <p style="margin-bottom: 2rem; color: #a4b8cc; line-height: 1.7;">
            Available for new projects, full-time remote roles, enterprise backend consulting, and technical leadership. Have an interesting challenge? Drop me a message below.
          </p>

          <div class="contact-methods" style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 2.5rem;">
            <a href="mailto:{{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}" class="method-card" style="display: flex; gap: 1rem; align-items: center; padding: 18px; background: var(--card); border: 1px solid var(--line); border-radius: 14px;">
              <i class="fa-solid fa-envelope" style="font-size: 1.5rem; color: var(--primary);"></i>
              <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 700;">Direct Email</span>
                <br><strong style="font-size: 1rem; color: var(--text);">{{ $settings['email'] ?? 'mdrabbihasan610@gmail.com' }}</strong>
              </div>
            </a>

            <div class="method-card" style="display: flex; gap: 1rem; align-items: center; padding: 18px; background: var(--card); border: 1px solid var(--line); border-radius: 14px;">
              <i class="fa-solid fa-location-dot" style="font-size: 1.5rem; color: var(--blue);"></i>
              <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 700;">Location & Timezone</span>
                <br><strong style="font-size: 1rem; color: var(--text);">{{ $settings['address'] ?? 'Dhaka, Bangladesh' }} (UTC+6)</strong>
              </div>
            </div>

            <div class="method-card" style="display: flex; gap: 1rem; align-items: center; padding: 18px; background: var(--card); border: 1px solid var(--line); border-radius: 14px;">
              <i class="fa-solid fa-phone" style="font-size: 1.5rem; color: #10b981;"></i>
              <div>
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 700;">WhatsApp / Phone</span>
                <br><strong style="font-size: 1rem; color: var(--text);">{{ $settings['phone'] ?? '+880 1684-208275' }}</strong>
              </div>
            </div>
          </div>

          {{-- Social Media Direct Links --}}
          <div class="social-channel-bar">
            @if(!empty($settings['linkedin']))
              <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-linkedin">
                <i class="fa-brands fa-linkedin"></i> LinkedIn
              </a>
            @endif
            @if(!empty($settings['github']))
              <a href="{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-github">
                <i class="fa-brands fa-github"></i> GitHub
              </a>
            @endif
            @if(!empty($settings['facebook']))
              <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-facebook">
                <i class="fa-brands fa-facebook"></i> Facebook
              </a>
            @endif
            @if(!empty($settings['youtube']))
              <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-youtube">
                <i class="fa-brands fa-youtube"></i> YouTube
              </a>
            @endif
            @if(!empty($settings['instagram']))
              <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-instagram">
                <i class="fa-brands fa-instagram"></i> Instagram
              </a>
            @endif
          </div>
        </div>

        {{-- Right Form Column --}}
        <div class="contact-form-wrap reveal">
          <div class="case-block" style="padding: 36px; background: var(--card); border: 1px solid var(--line); border-radius: 20px;">
            <h3 style="font-size: 1.4rem; margin-bottom: 8px;">Send Project Brief</h3>
            <p style="color: var(--muted); font-size: 0.9rem; margin-bottom: 24px;">
              Fill out this form and I will review your requirements and respond within 24 hours.
            </p>

            <form action="{{ route('contact.submit') }}" method="POST" id="contact-form" style="display: flex; flex-direction: column; gap: 18px;">
              @csrf
              <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--muted); margin-bottom: 6px;">Your Name *</label>
                <input 
                  type="text" 
                  name="name" 
                  required 
                  placeholder="e.g. John Doe"
                  style="width: 100%; padding: 0.85rem 1.2rem; border-radius: 8px; border: 1px solid var(--line); background: var(--card-solid); color: var(--text); outline: none;"
                >
              </div>

              <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--muted); margin-bottom: 6px;">Your Email *</label>
                <input 
                  type="email" 
                  name="email" 
                  required 
                  placeholder="john@example.com"
                  style="width: 100%; padding: 0.85rem 1.2rem; border-radius: 8px; border: 1px solid var(--line); background: var(--card-solid); color: var(--text); outline: none;"
                >
              </div>

              <div>
                <label style="display: block; font-size: 0.82rem; font-weight: 700; color: var(--muted); margin-bottom: 6px;">Project Details / Inquiries *</label>
                <textarea 
                  name="message" 
                  rows="5" 
                  required 
                  placeholder="Tell me about your product, expected timeline, and backend requirements..."
                  style="width: 100%; padding: 0.85rem 1.2rem; border-radius: 8px; border: 1px solid var(--line); background: var(--card-solid); color: var(--text); outline: none; resize: vertical;"
                ></textarea>
              </div>

              <button type="submit" class="button button-primary" style="margin-top: 8px;">
                Send Message <i class="fa-solid fa-paper-plane"></i>
              </button>

              <div class="form-status" style="font-size: 0.85rem; color: var(--muted); margin-top: 4px;"></div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
