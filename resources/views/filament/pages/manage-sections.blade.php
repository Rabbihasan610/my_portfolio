<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Header Status Card & Action Bar --}}
        <div style="background: linear-gradient(135deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.9)); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 20px 24px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;">
            <div>
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #10b981; box-shadow: 0 0 10px #10b981;"></span>
                    Live Portfolio Sections Manager
                </h2>
                <p style="color: #94a3b8; font-size: 0.875rem; margin: 4px 0 0;">
                    Manage all texts, picture, metrics, headings, social links, and SEO directly from this dashboard.
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); color: #e2e8f0; font-size: 0.875rem; font-weight: 600; text-decoration: none;">
                    <span>View Website</span>
                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </a>
                <button type="button" wire:click="save" wire:loading.attr="disabled" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 8px; background: #f59e0b; color: #000; font-size: 0.875rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s;">
                    <span wire:loading.remove wire:target="save">💾 Save All Changes</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </div>

        {{-- Navigation Tabs --}}
        <div style="display: flex; flex-wrap: wrap; gap: 8px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 8px;">
            @php
                $tabs = [
                    'hero' => ['label' => '🌟 Hero & Profile Picture', 'desc' => 'Avatar, bio & badges'],
                    'metrics' => ['label' => '📊 Key Metrics', 'desc' => 'Counter numbers'],
                    'headings' => ['label' => '🏷️ Section Titles', 'desc' => 'Eyebrows & texts'],
                    'social' => ['label' => '🌐 Social Channels', 'desc' => 'Follow & share links'],
                    'contact' => ['label' => '📞 Contact Info', 'desc' => 'Email, phone, location'],
                    'seo' => ['label' => '🔍 SEO & Meta', 'desc' => 'Title, tags, OpenGraph'],
                ];
            @endphp

            @foreach($tabs as $tabKey => $tabInfo)
                <button 
                    type="button" 
                    wire:click="setTab('{{ $tabKey }}')"
                    style="padding: 10px 18px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; cursor: pointer; border: 1px solid {{ $activeTab === $tabKey ? '#f59e0b' : 'rgba(255, 255, 255, 0.1)' }}; background: {{ $activeTab === $tabKey ? 'rgba(245, 158, 11, 0.15)' : 'rgba(255, 255, 255, 0.03)' }}; color: {{ $activeTab === $tabKey ? '#fbbf24' : '#94a3b8' }}; transition: all 0.15s;"
                >
                    {{ $tabInfo['label'] }}
                </button>
            @endforeach
        </div>

        {{-- Form Container --}}
        <form wire:submit.prevent="save" style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 24px;">

            {{-- TAB 1: HERO SECTION --}}
            @if($activeTab === 'hero')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Hero Section & Developer Portrait</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">Control the primary landing screen, availability status, your portrait picture, and action buttons.</p>
                    </div>

                    {{-- Image & Portrait Management Box --}}
                    <div style="background: rgba(30, 41, 59, 0.5); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 20px; display: grid; grid-template-columns: 180px 1fr; gap: 24px; align-items: center;">
                        <div style="text-align: center;">
                            <div style="width: 140px; height: 140px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 3px solid #f59e0b; background: #0b1526; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 25px rgba(245, 158, 11, 0.25);">
                                @if($hero_image_file)
                                    <img src="{{ $hero_image_file->temporaryUrl() }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset($settings['hero_image'] ?? 'assets/images/rabbi_hasan.svg') }}" alt="Current Hero Image" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <span style="font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 8px;">Active Portrait</span>
                        </div>
                        <div class="space-y-3">
                            <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #e2e8f0;">
                                Upload New Profile / Hero Image (PNG, JPG, SVG, WebP)
                            </label>
                            <input 
                                type="file" 
                                wire:model="hero_image_file" 
                                accept="image/*"
                                style="display: block; width: 100%; font-size: 0.85rem; color: #94a3b8; background: rgba(15, 23, 42, 0.6); padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(255, 255, 255, 0.15);"
                            >
                            <div wire:loading wire:target="hero_image_file" style="font-size: 0.8rem; color: #f59e0b;">
                                Uploading image preview...
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; color: #94a3b8; margin-bottom: 4px;">Or specify Image Path / Direct URL:</label>
                                <input 
                                    type="text" 
                                    wire:model.defer="settings.hero_image" 
                                    placeholder="assets/images/rabbi_hasan.svg or https://..."
                                    style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- Hero Fields Grid --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Hero Title / Full Name</label>
                            <input type="text" wire:model.defer="settings.hero_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Hero Subtitle / Main Role</label>
                            <input type="text" wire:model.defer="settings.hero_subtitle" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Availability Badge Text</label>
                            <input type="text" wire:model.defer="settings.hero_availability" placeholder="e.g. Available for selected projects" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Eyebrow / Tech Highlights Bar</label>
                            <input type="text" wire:model.defer="settings.hero_eyebrow" placeholder="e.g. Laravel • PHP • MySQL • Redis" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Hero Bio / Intro Pitch</label>
                        <textarea wire:model.defer="settings.hero_bio" rows="3" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem; line-height: 1.5;"></textarea>
                    </div>

                    {{-- Badges & Infrastructure status --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Floating Badge 1 (Top-Left)</label>
                            <input type="text" wire:model.defer="settings.hero_badge_1_text" placeholder="e.g. API: 99.9% Uptime" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Floating Badge 2 (Bottom-Right)</label>
                            <input type="text" wire:model.defer="settings.hero_badge_2_text" placeholder="e.g. Laravel 13 & PHP 8.3" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Infrastructure Chip Text</label>
                            <input type="text" wire:model.defer="settings.hero_infra_text" placeholder="e.g. Production Infrastructure: Docker • Nginx • Redis" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>

                    {{-- CTA Button Text Customization --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Primary CTA Button Label</label>
                            <input type="text" wire:model.defer="settings.hero_cta_primary_text" placeholder="View Projects & Case Studies" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Secondary CV Button Label</label>
                            <input type="text" wire:model.defer="settings.hero_cta_secondary_text" placeholder="View Full CV" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Contact Button Label</label>
                            <input type="text" wire:model.defer="settings.hero_cta_contact_text" placeholder="Contact Me" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>
                </div>
            @endif

            {{-- TAB 2: METRICS & NUMBERS --}}
            @if($activeTab === 'metrics')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Dynamic Key Metrics</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">The animated count-up numbers shown below the Hero section on the homepage.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px;">
                        {{-- Metric 1 --}}
                        <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 16px;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: #f59e0b; text-transform: uppercase;">Metric #1</span>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Number / Stat (e.g. 4+)</label>
                                <input type="text" wire:model.defer="settings.metric_1_number" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 1.1rem; font-weight: 700;">
                            </div>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Label</label>
                                <input type="text" wire:model.defer="settings.metric_1_label" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>

                        {{-- Metric 2 --}}
                        <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 16px;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: #f59e0b; text-transform: uppercase;">Metric #2</span>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Number / Stat (e.g. 25+)</label>
                                <input type="text" wire:model.defer="settings.metric_2_number" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 1.1rem; font-weight: 700;">
                            </div>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Label</label>
                                <input type="text" wire:model.defer="settings.metric_2_label" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>

                        {{-- Metric 3 --}}
                        <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 16px;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: #f59e0b; text-transform: uppercase;">Metric #3</span>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Number / Stat (e.g. 20+)</label>
                                <input type="text" wire:model.defer="settings.metric_3_number" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 1.1rem; font-weight: 700;">
                            </div>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Label</label>
                                <input type="text" wire:model.defer="settings.metric_3_label" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>

                        {{-- Metric 4 --}}
                        <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 16px;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: #f59e0b; text-transform: uppercase;">Metric #4</span>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Number / Stat (e.g. 99.9%)</label>
                                <input type="text" wire:model.defer="settings.metric_4_number" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 1.1rem; font-weight: 700;">
                            </div>
                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Label</label>
                                <input type="text" wire:model.defer="settings.metric_4_label" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TAB 3: SECTION HEADINGS & COPY --}}
            @if($activeTab === 'headings')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Website Section Headings & Text</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">Control every section title, eyebrow, and introductory description.</p>
                    </div>

                    {{-- 1. Services Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">1. Services Section</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.services_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.services_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.services_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    {{-- 2. Projects & Case Studies Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">2. Projects & Case Studies Section</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.projects_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.projects_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.projects_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    {{-- 3. Tech Stack Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">3. Tech Stack Showcase Section</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.stack_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.stack_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.stack_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    {{-- 4. Testimonials Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">4. Testimonials Section</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.testimonials_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.testimonials_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.testimonials_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    {{-- 5. Technical Blog Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">5. Technical Blog Section</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.blog_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.blog_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.blog_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                    </div>

                    {{-- 6. Call to Action (CTA) Section --}}
                    <div style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 18px;" class="space-y-3">
                        <h4 style="color: #f59e0b; font-weight: 700; font-size: 0.95rem; margin: 0;">6. Bottom Call to Action (Hire Me / Contact)</h4>
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Eyebrow</label>
                                <input type="text" wire:model.defer="settings.cta_eyebrow" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Main Title</label>
                                <input type="text" wire:model.defer="settings.cta_title" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Description</label>
                            <textarea wire:model.defer="settings.cta_description" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;"></textarea>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Primary Button Text</label>
                                <input type="text" wire:model.defer="settings.cta_primary_text" placeholder="Start a Conversation" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8rem; color: #cbd5e1; margin-bottom: 4px;">Secondary Button Text</label>
                                <input type="text" wire:model.defer="settings.cta_secondary_text" placeholder="Download Full CV (PDF)" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 8px 12px; border-radius: 6px; font-size: 0.85rem;">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TAB 4: SOCIAL CHANNELS --}}
            @if($activeTab === 'social')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Social Media & Follow Channels</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">These links appear in the Hero section quick bar, blog author card, and website footer.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-facebook" style="color: #1877f2;"></i> Facebook Profile / Page URL
                            </label>
                            <input type="url" wire:model.defer="settings.facebook" placeholder="https://facebook.com/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-youtube" style="color: #ff0000;"></i> YouTube Channel URL
                            </label>
                            <input type="url" wire:model.defer="settings.youtube" placeholder="https://youtube.com/@..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-instagram" style="color: #e4405f;"></i> Instagram Profile URL
                            </label>
                            <input type="url" wire:model.defer="settings.instagram" placeholder="https://instagram.com/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-linkedin" style="color: #0077b5;"></i> LinkedIn Profile URL
                            </label>
                            <input type="url" wire:model.defer="settings.linkedin" placeholder="https://linkedin.com/in/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-github" style="color: #e2e8f0;"></i> GitHub Profile URL
                            </label>
                            <input type="url" wire:model.defer="settings.github" placeholder="https://github.com/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-brands fa-x-twitter" style="color: #38bdf8;"></i> Twitter / X Profile URL
                            </label>
                            <input type="url" wire:model.defer="settings.twitter" placeholder="https://twitter.com/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">
                                <i class="fa-solid fa-mug-hot" style="color: #f59e0b;"></i> Buy Me a Coffee / Sponsor URL
                            </label>
                            <input type="url" wire:model.defer="settings.buy_me_a_coffee" placeholder="https://buymeacoffee.com/..." style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>
                </div>
            @endif

            {{-- TAB 5: CONTACT & GENERAL --}}
            @if($activeTab === 'contact')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Public Contact Details</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">These details are shown on the Contact page, in the footer, and in email notifications.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Primary Email Address</label>
                            <input type="email" wire:model.defer="settings.email" placeholder="you@domain.com" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Phone / WhatsApp Number</label>
                            <input type="text" wire:model.defer="settings.phone" placeholder="+880 1700 000000" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div style="grid-column: 1 / -1;">
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Location / Address</label>
                            <input type="text" wire:model.defer="settings.address" placeholder="Dhaka, Bangladesh" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>
                </div>
            @endif

            {{-- TAB 6: SEO & METADATA --}}
            @if($activeTab === 'seo')
                <div class="space-y-6">
                    <div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 4px;">Search Engine Optimization (SEO) & OpenGraph</h3>
                        <p style="font-size: 0.85rem; color: #94a3b8; margin: 0 0 20px;">Control meta tags, search engine indexing, social share preview card (OG Image), and JSON-LD schema.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px;">
                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Website Title (Browser Tab)</label>
                            <input type="text" wire:model.defer="settings.site_title" placeholder="Md Rabbi Hasan | Senior Laravel & PHP Developer" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">Website Tagline</label>
                            <input type="text" wire:model.defer="settings.site_tagline" placeholder="Enterprise Laravel Backend Architect" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">SEO Author Name</label>
                            <input type="text" wire:model.defer="settings.seo_author" placeholder="Md Rabbi Hasan" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">OpenGraph / Share Image Path or URL</label>
                            <input type="text" wire:model.defer="settings.seo_og_image" placeholder="assets/images/rabbi_hasan.svg" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem;">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">SEO Meta Description (Google Search Snippet)</label>
                        <textarea wire:model.defer="settings.site_description" rows="3" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.9rem; line-height: 1.5;"></textarea>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.825rem; font-weight: 600; color: #e2e8f0; margin-bottom: 6px;">SEO Keywords (Comma Separated)</label>
                        <textarea wire:model.defer="settings.site_keywords" rows="2" style="width: 100%; background: rgba(15, 23, 42, 0.8); border: 1px solid rgba(255, 255, 255, 0.15); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 0.85rem;"></textarea>
                    </div>
                </div>
            @endif

            {{-- Bottom Save Actions Bar --}}
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 0.8rem; color: #64748b;">
                    Changes will take effect instantly across all pages and XML sitemap.
                </span>
                <button type="button" wire:click="save" wire:loading.attr="disabled" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 24px; border-radius: 8px; background: #f59e0b; color: #000; font-size: 0.9rem; font-weight: 700; border: none; cursor: pointer;">
                    <span wire:loading.remove wire:target="save">💾 Save All Changes</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </form>
    </div>
</x-filament-panels::page>
