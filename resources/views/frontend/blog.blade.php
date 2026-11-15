@extends('frontend.layouts.app')

@section('title', 'Technical Blog | Laravel, Architecture & APIs | ' . ($settings['hero_title'] ?? 'Md Rabbi Hasan'))
@section('description', 'Technical articles, architectural blueprints, and engineering guides on Laravel, Redis caching, payment gateways, and backend scalability by Md Rabbi Hasan.')

@section('content')
  <div style="padding-top: 125px; padding-bottom: 90px;">
    <section class="section" id="blog" style="padding: 0;">
      <div class="container">
        
        {{-- Section Heading --}}
        <div class="reveal" style="text-align: center; max-width: 760px; margin: 0 auto 2.5rem;">
          <p class="eyebrow" style="margin-bottom: 8px;">Engineering Knowledge Base</p>
          <h1 style="font-size: clamp(2rem, 3.8vw, 3rem); font-weight: 800; letter-spacing: -0.03em; color: #ffffff; line-height: 1.2; margin-bottom: 14px;">
            Laravel &amp; Backend Architecture Blog
          </h1>
          <p style="color: #94a3b8; font-size: 1rem; line-height: 1.65; margin: 0;">
            Field notes, code patterns, and production lessons learned building high-traffic Laravel applications, distributed APIs, and scalable caching tiers.
          </p>
        </div>

        {{-- Category Filter Navigation --}}
        <div class="filter-nav reveal" style="margin-bottom: 1.8rem;">
          <a href="{{ route('blog', ['search' => $search]) }}" class="filter-tab {{ $activeCategory === 'All' && !$activeTag ? 'active' : '' }}">
            All Topics
          </a>
          @foreach($categories as $category)
            <a href="{{ route('blog', ['category' => $category, 'search' => $search]) }}" class="filter-tab {{ $activeCategory === $category ? 'active' : '' }}">
              {{ $category }}
            </a>
          @endforeach
        </div>

        {{-- Search Toolbar --}}
        <div class="reveal" style="max-width: 520px; margin: 0 auto 3.2rem;">
          <form action="{{ route('blog') }}" method="GET" style="display: flex; align-items: center; background: rgba(14, 25, 42, 0.7); padding: 8px 18px; border-radius: 999px; border: 1px solid rgba(148, 178, 211, 0.16); backdrop-filter: blur(8px);">
            @if($activeCategory && $activeCategory !== 'All')
              <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <i class="fa-solid fa-magnifying-glass" style="color: #64748b; margin-right: 12px; font-size: 0.9rem;"></i>
            <input 
              name="search" 
              type="search" 
              value="{{ $search }}" 
              placeholder="Search by keyword, topic, or tag..." 
              style="border: none; background: transparent; color: #ffffff; outline: none; width: 100%; font-size: 0.9rem;"
            >
            @if($search || $activeTag)
              <a href="{{ route('blog', ['category' => $activeCategory]) }}" style="color: #94a3b8; margin-left: 8px; font-size: 0.85rem;" title="Clear search">
                <i class="fa-solid fa-xmark"></i>
              </a>
            @endif
          </form>

          @if($activeTag)
            <div style="text-align: center; margin-top: 10px;">
              <span style="font-size: 0.78rem; color: #94a3b8; font-family: var(--mono);">
                Filtered by tag: <strong style="color: var(--primary);">#{{ $activeTag }}</strong>
                <a href="{{ route('blog', ['category' => $activeCategory]) }}" style="margin-left: 6px; color: #ef4444;"><i class="fa-solid fa-xmark"></i> Remove</a>
              </span>
            </div>
          @endif
        </div>

        {{-- Dynamic Blog Grid --}}
        <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 28px;">
          @forelse($posts as $post)
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
                  @if($post->youtube_video_id)
                    <span style="position: absolute; top: 12px; right: 12px; background: rgba(239, 68, 68, 0.9); backdrop-filter: blur(8px); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 3px 9px; border-radius: 6px; display: inline-flex; align-items: center; gap: 5px;">
                      <i class="fa-brands fa-youtube"></i> Video
                    </span>
                  @endif
                </div>
              @endif

              <div class="blog-card-body">
                {{-- Meta row --}}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 0.78rem; color: #94a3b8; font-family: var(--mono);">
                  <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
                  <span><i class="fa-regular fa-clock"></i> {{ $post->reading_time ?? '5 min read' }}</span>
                </div>

                {{-- Post Title --}}
                <h3 class="blog-card-title">
                  <a href="{{ route('blog.single', $post->slug) }}">
                    {{ $post->title }}
                  </a>
                </h3>

                {{-- Post Summary Excerpt --}}
                <p class="blog-card-summary">
                  {{ $post->summary ?? Str::limit(strip_tags($post->content), 125) }}
                </p>

                {{-- Tag Pills --}}
                @if($post->tags)
                  <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 20px;">
                    @foreach($post->tag_list as $tag)
                      <a href="{{ route('blog', ['tag' => $tag]) }}" style="font-size: 0.72rem; padding: 2px 8px; background: rgba(255,255,255,0.04); border-radius: 4px; border: 1px solid rgba(148, 178, 211, 0.12); color: #94a3b8; font-family: var(--mono);">
                        #{{ $tag }}
                      </a>
                    @endforeach
                  </div>
                @endif

                {{-- Card Footer --}}
                <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center; padding-top: 14px; border-top: 1px solid rgba(148, 178, 211, 0.12);">
                  <span style="font-size: 0.76rem; color: #64748b; font-family: var(--mono);">
                    <i class="fa-regular fa-eye"></i> {{ number_format($post->views_count) }} views
                  </span>
                  <a href="{{ route('blog.single', $post->slug) }}" class="button button-primary" style="min-height: 36px; padding: 0 16px; font-size: 0.78rem;">
                    Read Article <i class="fa-solid fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </article>
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4.5rem 1.5rem; background: rgba(14, 25, 42, 0.4); border: 1px dashed rgba(148, 178, 211, 0.18); border-radius: 18px;">
              <i class="fa-solid fa-newspaper" style="font-size: 2.8rem; color: var(--primary); margin-bottom: 12px;"></i>
              <h3 style="margin-bottom: 8px; color: #ffffff;">No articles found</h3>
              <p style="color: #94a3b8; margin-bottom: 1.5rem; font-size: 0.92rem;">We couldn't find any articles matching your search query.</p>
              <a href="{{ route('blog') }}" class="button button-secondary">Reset Filters</a>
            </div>
          @endforelse
        </div>

      </div>
    </section>
  </div>
@endsection
