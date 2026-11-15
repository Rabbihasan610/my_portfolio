@extends('frontend.layouts.app')

@section('title', $post->title . ' | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', $post->summary ?? Str::limit(strip_tags($post->content), 160))
@section('og_title', $post->title)
@section('og_description', $post->summary ?? Str::limit(strip_tags($post->content), 160))
@section('og_image', asset($post->image ?? 'assets/images/og-cover.jpg'))
@section('og_type', 'article')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": "{{ addslashes($post->title) }}",
  "description": "{{ addslashes($post->summary ?? Str::limit(strip_tags($post->content), 200)) }}",
  "image": "{{ asset($post->image ?? 'assets/images/og-cover.jpg') }}",
  "author": {
    "@@type": "Person",
    "name": "{{ $post->author_name ?? 'Md Rabbi Hasan' }}",
    "url": "{{ url('/') }}"
  },
  "publisher": {
    "@@type": "Person",
    "name": "{{ $settings['hero_title'] ?? 'Md Rabbi Hasan' }}"
  },
  "datePublished": "{{ $post->created_at->toAtomString() }}",
  "dateModified": "{{ $post->updated_at->toAtomString() }}",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('blog.single', $post->slug) }}"
  }
}
</script>
@endsection

@section('content')
  {{-- Reading Progress Bar indicator at the top --}}
  <div class="reading-progress-bar" aria-hidden="true"></div>

  <div style="padding-top: 125px; padding-bottom: 90px;">
    <article class="container" style="max-width: 840px;">
      
      {{-- Clean Breadcrumbs --}}
      <nav class="article-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i>
        <a href="{{ route('blog') }}">Blog</a>
        @if($post->category)
          <i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i>
          <a href="{{ route('blog', ['category' => $post->category]) }}">{{ $post->category }}</a>
        @endif
        <i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i>
        <span class="current">{{ $post->title }}</span>
      </nav>

      {{-- Post Header --}}
      <header class="reveal" style="margin-bottom: 35px;">
        {{-- Metadata pills --}}
        <div class="article-header-meta">
          @if($post->category)
            <span class="badge-category-pill">{{ $post->category }}</span>
          @endif
          <span class="meta-pill">
            <i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
          </span>
          <span class="meta-pill">
            <i class="fa-regular fa-clock"></i> {{ $post->reading_time ?? '5 min read' }}
          </span>
          <span class="meta-pill">
            <i class="fa-regular fa-eye"></i> {{ number_format($post->views_count) }} views
          </span>
        </div>

        {{-- Post Title --}}
        <h1 style="font-size: clamp(2rem, 3.8vw, 3rem); font-weight: 800; line-height: 1.2; letter-spacing: -0.03em; color: #ffffff; margin-bottom: 22px;">
          {{ $post->title }}
        </h1>

        {{-- Author Sub-header Bar --}}
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; padding: 16px 20px; background: rgba(14, 25, 42, 0.6); border: 1px solid rgba(148, 178, 211, 0.12); border-radius: 14px;">
          <div style="display: flex; align-items: center; gap: 14px;">
            <div style="width: 44px; height: 44px; border-radius: 50%; overflow: hidden; border: 2px solid var(--primary); background: #081320; flex-shrink: 0;">
              <img src="{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}" alt="{{ $post->author_name ?? 'Md Rabbi Hasan' }}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div>
              <strong style="color: #ffffff; font-size: 0.95rem; display: block;">{{ $post->author_name ?? 'Md Rabbi Hasan' }}</strong>
              <span style="color: #94a3b8; font-size: 0.78rem;">Mid-Level Laravel &amp; PHP Developer • Dhaka, Bangladesh</span>
            </div>
          </div>
          <button type="button" onclick="copyArticleLink(this)" class="button button-secondary" style="min-height: 36px; padding: 0 14px; font-size: 0.78rem;">
            <i class="fa-solid fa-share-nodes"></i> Share Link
          </button>
        </div>
      </header>

      {{-- Featured Image Banner --}}
      @if($post->image)
        <div class="reveal" style="width: 100%; max-height: 460px; border-radius: 20px; overflow: hidden; margin-bottom: 40px; border: 1px solid rgba(148, 178, 211, 0.15); box-shadow: 0 16px 45px rgba(0, 0, 0, 0.45);">
          <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
        </div>
      @endif

      {{-- Embedded YouTube Video Walkthrough (if set) --}}
      @if($post->youtube_video_id)
        <div class="video-walkthrough-box reveal">
          <div class="video-walkthrough-header">
            <i class="fa-brands fa-youtube"></i>
            <span>Video Walkthrough &amp; Practical Implementation</span>
          </div>

          <div class="video-responsive-wrap" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
            <iframe 
              src="https://www.youtube.com/embed/{{ $post->youtube_video_id }}?rel=0&modestbranding=1" 
              title="{{ $post->title }} Video Walkthrough" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen
              style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
            ></iframe>
          </div>
          <p style="font-size: 0.825rem; color: #94a3b8; margin-top: 12px; margin-bottom: 0;">
            Follow along with the step-by-step code demonstration on YouTube.
          </p>
        </div>
      @endif

      {{-- Article Body Content (Ultra-Readable Developer Prose) --}}
      <div class="blog-content reveal">
        {!! $post->content !!}
      </div>

      {{-- Article Tags Cloud --}}
      @if($post->tags)
        <div class="reveal" style="margin-top: 45px; padding-top: 24px; border-top: 1px solid rgba(148, 178, 211, 0.12); display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
          <span style="color: #94a3b8; font-size: 0.8rem; font-family: var(--mono); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">
            <i class="fa-solid fa-tags" style="color: var(--primary); margin-right: 4px;"></i> Tags:
          </span>
          <div style="display: flex; flex-wrap: wrap; gap: 8px;">
            @foreach($post->tag_list as $tag)
              <a href="{{ route('blog', ['tag' => $tag]) }}" class="skill-tag-pill" style="font-size: 0.78rem;">
                #{{ $tag }}
              </a>
            @endforeach
          </div>
        </div>
      @endif

      {{-- Social Share Bar --}}
      @php
        $shareUrl = urlencode(url()->current());
        $shareTitle = urlencode($post->title . ' by @rabbihasan610');
      @endphp
      <div class="blog-share-card reveal">
        <div>
          <strong style="display: block; font-size: 0.95rem; color: #ffffff; margin-bottom: 3px;">
            Enjoyed this technical guide?
          </strong>
          <small style="color: #94a3b8; font-size: 0.82rem;">Share it with fellow developers and engineering teams</small>
        </div>

        <div class="share-buttons" style="display: flex; gap: 8px; flex-wrap: wrap;">
          {{-- Facebook Share --}}
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="share-btn" style="background: #1877f2;" title="Share on Facebook">
            <i class="fa-brands fa-facebook-f"></i> Facebook
          </a>

          {{-- LinkedIn Share --}}
          <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="share-btn" style="background: #0a66c2;" title="Share on LinkedIn">
            <i class="fa-brands fa-linkedin-in"></i> LinkedIn
          </a>

          {{-- X / Twitter Share --}}
          <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="share-btn" style="background: #000; border: 1px solid rgba(255,255,255,0.2);" title="Share on X">
            <i class="fa-brands fa-x-twitter"></i> Post
          </a>

          {{-- WhatsApp Share --}}
          <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="share-btn" style="background: #25d366; color: #04251d;" title="Share via WhatsApp">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp
          </a>

          {{-- 1-Click Copy Link --}}
          <button type="button" onclick="copyArticleLink(this)" class="share-btn" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(148, 178, 211, 0.2); color: #f1f5f9;" title="Copy article link">
            <i class="fa-solid fa-link"></i> Copy Link
          </button>
        </div>
      </div>

      {{-- Author Profile Box with Social Follow Links --}}
      <div class="author-profile-card reveal">
        <div class="author-avatar">
          <img src="{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}" alt="{{ $post->author_name ?? 'Md Rabbi Hasan' }}">
        </div>

        <div style="flex: 1;">
          <span style="font-size: 0.72rem; text-transform: uppercase; color: var(--primary); font-weight: 700; font-family: var(--mono); letter-spacing: 0.08em; display: block; margin-bottom: 2px;">
            Written By
          </span>
          <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0 0 8px; color: #ffffff;">
            {{ $post->author_name ?? 'Md Rabbi Hasan' }}
          </h3>
          <p style="font-size: 0.9rem; color: #94a3b8; line-height: 1.62; margin-bottom: 16px;">
            Mid-Level Laravel &amp; PHP Developer from Bangladesh specializing in scalable backends, high-throughput Redis caching, payment gateways, and enterprise SaaS architecture.
          </p>

          {{-- Social Follow Links (Facebook, YouTube, Instagram, LinkedIn, GitHub) --}}
          <div class="social-channel-bar" style="gap: 8px;">
            @if(!empty($settings['linkedin']))
              <a href="{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-linkedin">
                <i class="fa-brands fa-linkedin"></i> <span>LinkedIn</span>
              </a>
            @endif
            @if(!empty($settings['youtube']))
              <a href="{{ $settings['youtube'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-youtube">
                <i class="fa-brands fa-youtube"></i> <span>YouTube</span>
              </a>
            @endif
            @if(!empty($settings['facebook']))
              <a href="{{ $settings['facebook'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-facebook">
                <i class="fa-brands fa-facebook"></i> <span>Facebook</span>
              </a>
            @endif
            @if(!empty($settings['instagram']))
              <a href="{{ $settings['instagram'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-instagram">
                <i class="fa-brands fa-instagram"></i> <span>Instagram</span>
              </a>
            @endif
            @if(!empty($settings['github']))
              <a href="{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="social-pill-btn sp-github">
                <i class="fa-brands fa-github"></i> <span>GitHub</span>
              </a>
            @endif
          </div>
        </div>
      </div>

      {{-- Comments & Discussion Section --}}
      <section class="reveal" style="margin-top: 55px; padding-top: 35px; border-top: 1px solid rgba(148, 178, 211, 0.12);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 26px;">
          <h3 style="font-size: 1.45rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 10px; color: #ffffff;">
            <i class="fa-regular fa-comments" style="color: var(--primary);"></i>
            <span>Discussion &amp; Feedback ({{ $comments->count() }})</span>
          </h3>
          <span style="font-size: 0.78rem; color: #64748b; font-family: var(--mono);">Moderated for quality</span>
        </div>

        {{-- Comments List --}}
        <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 40px;">
          @forelse($comments as $comment)
            <div class="comment-card">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                  <div class="comment-avatar">
                    {{ strtoupper(substr($comment->guest_name, 0, 1)) }}
                  </div>
                  <div>
                    <strong style="color: #ffffff; font-size: 0.92rem; display: block;">{{ $comment->guest_name }}</strong>
                    <small style="color: #64748b; font-size: 0.75rem;">{{ $comment->created_at->diffForHumans() }}</small>
                  </div>
                </div>
              </div>
              <p style="color: #cbd5e1; font-size: 0.92rem; line-height: 1.65; margin: 0; padding-left: 50px;">
                {{ $comment->content }}
              </p>
            </div>
          @empty
            <div style="text-align: center; padding: 2.5rem 1.5rem; background: rgba(14, 25, 42, 0.45); border: 1px dashed rgba(148, 178, 211, 0.18); border-radius: 14px;">
              <i class="fa-regular fa-comment-dots" style="font-size: 2rem; color: var(--primary); margin-bottom: 8px;"></i>
              <p style="color: #94a3b8; font-size: 0.92rem; margin: 0;">No comments yet. Have thoughts or questions on this architecture? Share below!</p>
            </div>
          @endforelse
        </div>

        {{-- Leave Comment Form Box --}}
        <div style="background: rgba(14, 25, 42, 0.7); border: 1px solid rgba(148, 178, 211, 0.14); border-radius: 18px; padding: 30px;">
          <h4 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 6px; color: #ffffff;">Join the Conversation</h4>
          <p style="font-size: 0.85rem; color: #94a3b8; margin-bottom: 20px;">Your email is kept private and comments are published upon quick moderation.</p>
          
          @if(session('comment_success'))
            <div class="app-alert alert-success" style="margin-bottom: 20px;">
              <i class="fa-solid fa-circle-check"></i>
              <span>{{ session('comment_success') }}</span>
            </div>
          @endif

          <form action="{{ route('comment.submit', $post->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Your Name *</label>
                <input 
                  type="text" 
                  name="guest_name" 
                  required 
                  placeholder="e.g. Alex Morgan" 
                  style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid rgba(148, 178, 211, 0.18); background: rgba(7, 13, 24, 0.8); color: #ffffff; outline: none; font-size: 0.88rem;"
                >
              </div>
              <div>
                <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Your Email (Optional)</label>
                <input 
                  type="email" 
                  name="guest_email" 
                  placeholder="alex@company.com" 
                  style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid rgba(148, 178, 211, 0.18); background: rgba(7, 13, 24, 0.8); color: #ffffff; outline: none; font-size: 0.88rem;"
                >
              </div>
            </div>

            <div>
              <label style="display: block; font-size: 0.8rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Your Thoughts / Feedback *</label>
              <textarea 
                name="content" 
                rows="4" 
                required 
                placeholder="Share your technical thoughts, questions, or architectural suggestions..." 
                style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1px solid rgba(148, 178, 211, 0.18); background: rgba(7, 13, 24, 0.8); color: #ffffff; outline: none; font-size: 0.88rem; line-height: 1.6; resize: vertical;"
              ></textarea>
            </div>

            <button type="submit" class="button button-primary" style="align-self: flex-start; min-height: 42px;">
              Submit Comment <i class="fa-solid fa-paper-plane"></i>
            </button>
          </form>
        </div>
      </section>

      {{-- Related Recommended Articles --}}
      @if($relatedPosts->isNotEmpty())
        <section class="reveal" style="margin-top: 65px; padding-top: 35px; border-top: 1px solid rgba(148, 178, 211, 0.12);">
          <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
            <div>
              <p class="eyebrow" style="margin-bottom: 4px;">Recommended Reading</p>
              <h2 style="font-size: 1.55rem; font-weight: 700; color: #ffffff; margin: 0;">More Technical Guides</h2>
            </div>
            <a href="{{ route('blog') }}" class="button button-secondary" style="font-size: 0.8rem; padding: 0 16px; min-height: 38px;">
              Browse All <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>

          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
            @foreach($relatedPosts as $rel)
              <article class="blog-card" style="padding: 0;">
                @if($rel->image)
                  <div style="height: 140px; overflow: hidden; background: #081320;">
                    <img src="{{ asset($rel->image) }}" alt="{{ $rel->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                @endif
                <div style="padding: 20px; display: flex; flex-direction: column; flex: 1;">
                  <span style="font-size: 0.7rem; color: var(--primary); font-weight: 700; font-family: var(--mono); text-transform: uppercase; margin-bottom: 6px;">
                    {{ $rel->category }}
                  </span>
                  <h4 style="font-size: 1.05rem; font-weight: 700; line-height: 1.4; margin-bottom: 8px;">
                    <a href="{{ route('blog.single', $rel->slug) }}" style="color: #ffffff;">
                      {{ $rel->title }}
                    </a>
                  </h4>
                  <p style="font-size: 0.84rem; color: #94a3b8; line-height: 1.6; margin-bottom: 14px; margin-top: auto;">
                    {{ Str::limit($rel->summary ?? strip_tags($rel->content), 95) }}
                  </p>
                  <a href="{{ route('blog.single', $rel->slug) }}" style="color: var(--primary); font-size: 0.82rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                    Read Article <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </article>
            @endforeach
          </div>
        </section>
      @endif

    </article>
  </div>
@endsection
