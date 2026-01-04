@extends('layouts.app')

@section('content')

{{-- Modern Slider Section --}}
@if($sliders->isNotEmpty())
<div x-data="{
    currentSlide: 0,
    slides: {{ $sliders->count() }},
    autoplay: true,
    interval: null,
    init() {
        if (this.autoplay) {
            this.startAutoplay();
        }
    },
    startAutoplay() {
        this.interval = setInterval(() => {
            this.next();
        }, 5000);
    },
    stopAutoplay() {
        clearInterval(this.interval);
    },
    next() {
        this.currentSlide = (this.currentSlide + 1) % this.slides;
    },
    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.slides) % this.slides;
    },
    goTo(index) {
        this.currentSlide = index;
        this.stopAutoplay();
        setTimeout(() => this.startAutoplay(), 10000);
    }
}" 
@mouseenter="stopAutoplay()" 
@mouseleave="startAutoplay()"
class="relative w-full h-[400px] sm:h-[500px] lg:h-[600px] overflow-hidden bg-slate-900">
    
    {{-- Slides --}}
    <div class="relative w-full h-full">
        @foreach($sliders as $index => $slider)
        <div x-show="currentSlide === {{ $index }}"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="absolute inset-0">
            
            {{-- Background Image --}}
            @if($slider->image)
            <img src="{{ Storage::url($slider->image) }}" 
                 alt="{{ $slider->title }}"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/70 via-slate-900/50 to-transparent"></div>
            @else
            <div class="absolute inset-0 bg-gradient-to-br from-brand-600 to-accent-600"></div>
            @endif
            
            {{-- Content --}}
            <div class="absolute inset-0 flex items-center">
                <div class="container-custom">
                    <div class="max-w-2xl space-y-4 lg:space-y-6 text-white">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight animate-slide-up">
                            {{ $slider->title }}
                        </h1>
                        
                        @if($slider->subtitle)
                        <p class="text-lg sm:text-xl lg:text-2xl font-light opacity-90 animate-slide-up" style="animation-delay: 0.1s;">
                            {{ $slider->subtitle }}
                        </p>
                        @endif
                        
                        @if($slider->description)
                        <p class="text-base sm:text-lg opacity-75 animate-slide-up" style="animation-delay: 0.2s;">
                            {{ $slider->description }}
                        </p>
                        @endif
                        
                        @if($slider->button_text && $slider->button_link)
                        <div class="pt-4 animate-slide-up" style="animation-delay: 0.3s;">
                            <a href="{{ $slider->button_link }}" class="btn-gradient-primary">
                                {{ $slider->button_text }}
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- Navigation Arrows - Hidden on small screens --}}
    <button @click="prev()" 
            class="hidden lg:flex absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all text-white z-10">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    
    <button @click="next()" 
            class="hidden lg:flex absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 items-center justify-center rounded-full bg-white/10 backdrop-blur-sm hover:bg-white/20 transition-all text-white z-10">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    
    {{-- Indicator Dots --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
        @foreach($sliders as $index => $slider)
        <button @click="goTo({{ $index }})"
                class="w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-all duration-300"
                :class="currentSlide === {{ $index }} ? 'bg-white w-6 sm:w-8' : 'bg-white/50 hover:bg-white/75'">
        </button>
        @endforeach
    </div>
</div>
@endif

@foreach($sections as $section)
    @switch($section->type)
        @case('hero')
            {{-- Premium Hero Section - Expert Design --}}
            <div class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-slate-50 via-white to-slate-50">
                
                {{-- Animated Background Orbs - Subtle & Professional --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 right-[10%] w-96 h-96 bg-brand-400/10 rounded-full blur-3xl animate-float"></div>
                    <div class="absolute bottom-20 left-[15%] w-80 h-80 bg-accent-400/10 rounded-full blur-3xl animate-float" style="animation-delay: -2s; animation-duration: 8s;"></div>
                    <div class="absolute top-1/2 right-[30%] w-64 h-64 bg-brand-300/5 rounded-full blur-2xl animate-float" style="animation-delay: -4s; animation-duration: 10s;"></div>
                </div>

                {{-- Grid Pattern Overlay --}}
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] pointer-events-none"></div>

                <div class="container-custom relative z-10 py-20 lg:py-32">
                    <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center">
                        
                        {{-- Left Content - 7 columns --}}
                        <div class="lg:col-span-7 space-y-8">
                            
                            {{-- Badge/Tag --}}
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium animate-slide-down">
                                <div class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></div>
                                <span>Türkiye'nin Güvenlik Lideri</span>
                            </div>

                            {{-- Main Headline - Bold & Impactful --}}
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold leading-[1.1] tracking-tight text-slate-900 animate-slide-up">
                                <span class="block">{{ $section->title ?? setting('hero_title', 'Güvenliğiniz,') }}</span>
                                <span class="block mt-2 bg-gradient-to-r from-brand-600 via-accent-600 to-brand-700 bg-clip-text text-transparent">
                                    Bizim İşimiz
                                </span>
                            </h1>

                            {{-- Subtitle - Large, Readable --}}
                            <p class="text-lg sm:text-xl lg:text-2xl text-slate-600 leading-relaxed max-w-2xl animate-slide-up" style="animation-delay: 0.1s;">
                                {{ $section->subtitle ?? setting('hero_subtitle', 'Yeni nesil güvenlik teknolojileri ile işletmenizi ve evinizi 7/24 koruma altına alın.') }}
                            </p>

                            {{-- Feature Pills --}}
                            <div class="flex flex-wrap gap-3 animate-slide-up" style="animation-delay: 0.2s;">
                                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition-all">
                                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">24/7 Teknik Destek</span>
                                </div>
                                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition-all">
                                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">81 İlde Hizmet</span>
                                </div>
                                <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition-all">
                                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm font-medium text-slate-700">Garantili Kurulum</span>
                                </div>
                            </div>

                            {{-- CTA Buttons - Professional Spacing --}}
                            <div class="flex flex-col sm:flex-row gap-4 pt-4 animate-slide-up" style="animation-delay: 0.3s;">
                                <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-brand-600 text-white font-semibold text-base hover:bg-brand-700 active:bg-brand-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:shadow-brand-600/20">
                                    <span>Ücretsiz Keşif</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <a href="{{ route('services.index') }}" class="group inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-white text-slate-900 font-semibold border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <span>Çözümlerimiz</span>
                                    <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            {{-- Social Proof - Compact Stats --}}
                            <div class="flex items-center gap-8 pt-8 border-t border-slate-200 animate-slide-up" style="animation-delay: 0.4s;">
                                <div>
                                    <div class="text-3xl font-bold text-slate-900">15+</div>
                                    <div class="text-sm text-slate-600">Yıllık Tecrübe</div>
                                </div>
                                <div class="w-px h-12 bg-slate-200"></div>
                                <div>
                                    <div class="text-3xl font-bold text-slate-900">5K+</div>
                                    <div class="text-sm text-slate-600">Mutlu Müşteri</div>
                                </div>
                                <div class="w-px h-12 bg-slate-200"></div>
                                <div>
                                    <div class="text-3xl font-bold text-slate-900">%99</div>
                                    <div class="text-sm text-slate-600">Memnuniyet</div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Visual - 5 columns --}}
                        <div class="lg:col-span-5 relative animate-scale-in" style="animation-delay: 0.2s;">
                            <div class="relative">
                                {{-- Main Image Container with Glassmorphism --}}
                                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                                    <div class="aspect-[4/5] bg-gradient-to-br from-brand-500 to-accent-500">
                                        @if($section->image)
                                        <img src="{{ Storage::url($section->image) }}" 
                                             alt="Hero" 
                                             class="w-full h-full object-cover mix-blend-overlay opacity-80">
                                        @else
                                        {{-- Default Pattern/Icon --}}
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-48 h-48 text-white/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Floating Stats Card --}}
                                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-4 border border-slate-100 backdrop-blur-sm animate-float hidden lg:block">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">7/24 Aktif</div>
                                            <div class="text-xs text-slate-600">Kesintisiz Hizmet</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Floating Security Badge --}}
                                <div class="absolute -top-6 -right-6 bg-white rounded-2xl shadow-xl p-4 border border-slate-100 backdrop-blur-sm animate-float hidden lg:block" style="animation-delay: -1s;">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-brand-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900">Güvenli</div>
                                            <div class="text-xs text-slate-600">SSL Sertifikalı</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 animate-bounce">
                    <span class="text-xs text-slate-400 uppercase tracking-wide">Keşfet</span>
                    <svg class="w-6 h-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
            @break
                                    <span class="text-sm font-medium text-gray-500">Uzman Teknik Destek</span>
                                </div>
                            </div>
                        </div>

                        {{-- Hero Image / Dashboard Mockup --}}
                        <div class="relative lg:h-[700px] flex items-center justify-center animate-fade-in" style="animation-delay: 0.3s;">
                            @if($section->image)
                                <img src="{{ Storage::url($section->image) }}" alt="Hero Image" class="relative z-10 w-full rounded-3xl shadow-2xl border border-gray-100">
                            @else
                            <div class="relative z-10 w-full aspect-square max-w-[600px]">
                                {{-- Main Circle Image --}}
                                <div class="absolute inset-4 rounded-full overflow-hidden shadow-2xl border-8 border-white/50 backdrop-blur-sm">
                                    <img src="https://images.unsplash.com/photo-1557597774-9d273605dfa9?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover scale-110 hover:scale-100 transition duration-1000" alt="Security Dashboard">
                                    
                                    {{-- Overlay Gradient --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    
                                    {{-- Floating UI Card 1 --}}
                                    <div class="absolute bottom-12 left-12 bg-white/90 backdrop-blur-xl p-4 rounded-2xl shadow-strong border border-white/50 animate-float">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">Sistem Aktif</div>
                                                <div class="text-xs text-gray-500">Tüm sensörler devrede</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Decorative Rings --}}
                                <div class="absolute inset-0 rounded-full border border-cyan-500/10 scale-90 animate-pulse"></div>
                                <div class="absolute inset-0 rounded-full border border-purple-500/10 scale-110 animate-pulse" style="animation-delay: 1s;"></div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @break

        @case('stats')
            {{-- Stats Section --}}
            <div class="py-12 bg-gray-50 border-y border-gray-100">
                <div class="container-custom">
                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200/50">
                        @php
                            $stats = [
                                ['value' => setting('stat_1_value', '15+'), 'label' => setting('stat_1_label', 'Yıllık Tecrübe')],
                                ['value' => setting('stat_2_value', '1000+'), 'label' => setting('stat_2_label', 'Mutlu Müşteri')],
                                ['value' => setting('stat_3_value', '50+'), 'label' => setting('stat_3_label', 'Uzman Personel')],
                                ['value' => setting('stat_4_value', '81'), 'label' => setting('stat_4_label', 'İlde Hizmet')],
                            ];
                        @endphp
                        @foreach($stats as $stat)
                        <div class="text-center px-4 group">
                            <div class="stat-number group-hover:scale-110 transition-transform duration-300">{{ $stat['value'] }}</div>
                            <div class="stat-label">{{ $stat['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @break

        @case('services')
            {{-- Services Section --}}
            <section class="section-padding relative overflow-hidden">
                <div class="container-custom">
                    <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-20">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 lg:mb-6">
                            <span class="text-gradient">Akıllı Çözümlerimiz</span>
                        </h2>
                        <p class="text-base sm:text-lg lg:text-xl text-slate-600">
                            İşletmeniz ve eviniz için en uygun, ölçeklenebilir ve güvenilir teknoloji altyapıları.
                        </p>
                    </div>

                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                        @foreach($services as $service)
                        <div class="card-gradient-border group">
                            <div class="p-5 sm:p-6 lg:p-8">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 rounded-2xl bg-slate-50 flex items-center justify-center mb-4 lg:mb-6 group-hover:bg-brand-50 transition-colors duration-300">
                                    <img src="{{ $service->image ? Storage::url($service->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRz-k3qGvM3g1S-XgE1CgE22gX1jG1k9l5g9g&s' }}" class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 opacity-60 group-hover:opacity-100 transition-opacity" alt="Icon">
                                </div>
                                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-slate-900 mb-3 lg:mb-4 group-hover:text-brand-600 transition-colors">{{ $service->title }}</h3>
                                <p class="text-sm sm:text-base text-slate-600 mb-4 lg:mb-6 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($service->content), 120) }}
                                </p>
                                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-xs sm:text-sm font-bold text-slate-900 hover:text-brand-600 transition-colors">
                                    Daha Fazla
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @break

        @case('features')
            {{-- Features Section --}}
            <section class="section-padding bg-gray-50 relative">
                <div class="container-custom">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <h2 class="heading-xl mb-8">Neden <span class="text-gradient">SOHO Güvenlik?</span></h2>
                            <div class="space-y-8">
                                @php
                                    $features = [
                                        ['title' => 'Ulusal Hizmet Ağı', 'desc' => 'Türkiye\'nin 81 ilinde kurulum ve teknik servis desteği.'],
                                        ['title' => 'Garantili İşçilik', 'desc' => 'Yapılan tüm montaj ve kurulumlarımız firma garantisi altındadır.'],
                                        ['title' => 'Hızlı Müdahale', 'desc' => 'Arıza durumunda 24 saat içerisinde teknik ekip yönlendirmesi.'],
                                    ];
                                @endphp
                                @foreach($features as $feature)
                                <div class="flex gap-6 group">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white shadow-soft flex items-center justify-center border border-gray-100 group-hover:border-cyan-200 transition-colors">
                                        <svg class="w-6 h-6 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h4>
                                        <p class="text-gray-600">{{ $feature['desc'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="relative">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-6 mt-12">
                                    <div class="card-modern bg-white p-6 animate-float">
                                        <div class="text-4xl font-bold text-cyan-500 mb-2">A+</div>
                                        <div class="text-gray-600 text-sm font-medium">Kalite Standartları</div>
                                    </div>
                                    <div class="img-ellipse h-64 w-full">
                                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" class="w-full h-full object-cover" alt="Team">
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="img-ellipse h-64 w-full">
                                        <img src="https://images.unsplash.com/photo-1581092921461-eab62e97a782?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Tech">
                                    </div>
                                    <div class="card-modern bg-white p-6 animate-float" style="animation-delay: -1s;">
                                        <div class="text-4xl font-bold text-purple-500 mb-2">20+</div>
                                        <div class="text-gray-600 text-sm font-medium">Global Marka Partneri</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @break

        @case('clients')
            {{-- Clients Section --}}
            <section class="py-20 bg-white border-t border-gray-100">
                <div class="container-custom">
                    <p class="text-center text-sm font-bold text-gray-400 uppercase tracking-widest mb-12">Güvenle Hizmet Verdiğimiz Markalar</p>
                    <div class="flex flex-wrap justify-center items-center gap-12 opacity-60">
                         @foreach($clients as $client)
                            <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="h-12 w-auto grayscale hover:grayscale-0 transition duration-300">
                        @endforeach
                        {{-- Fallback if no clients --}}
                        @if($clients->isEmpty())
                            <div class="text-gray-300 italic text-sm">Referans logoları eklenecek...</div>
                        @endif
                    </div>
                </div>
            </section>
            @break
            
        @case('testimonials')
             {{-- Testimonials --}}
             <section class="section-padding bg-gray-50">
                <div class="container-custom">
                    <h2 class="heading-xl text-center mb-16">Müşterilerimiz Ne Diyor?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                        <div class="card-modern p-8">
                            <div class="flex gap-1 text-amber-400 mb-6">
                                @for($i=0; $i<5; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                            </div>
                            <p class="text-gray-600 mb-6 italic">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden">
                                     <img src="{{ $testimonial->image ? Storage::url($testimonial->image) : 'https://ui-avatars.com/api/?name='.urlencode($testimonial->name) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $testimonial->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $testimonial->company ?? 'Müşteri' }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
             </section>
            @break

        @case('cta')
            {{-- CTA Section --}}
            <section class="py-24 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-purple-600"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                <div class="container-custom relative z-10 text-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-8 tracking-tight">Güvenliğiniz İçin Profesyonel Çözüm Zamanı</h2>
                    <p class="text-xl text-cyan-100 mb-12 max-w-2xl mx-auto">Ücretsiz keşif hizmetimizden yararlanın, işletmeniz için en uygun güvenlik altyapısını birlikte planlayalım.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('contact') }}" class="px-8 py-4 rounded-full bg-white text-gray-900 font-bold hover:bg-gray-50 hover:scale-105 transition transform shadow-lg">Teklif Al</a>
                        <a href="{{ route('contact') }}" class="px-8 py-4 rounded-full border-2 border-white text-white font-bold hover:bg-white/10 transition">İletişime Geç</a>
                    </div>
                </div>
            </section>
            @break
            
        @case('custom')
            {{-- Custom Content --}}
            @if($section->content)
                <section class="section-padding {{ $section->bg_color ?? 'bg-white' }}">
                    <div class="container-custom">
                         @if($section->title) <h2 class="heading-xl text-center mb-8">{{ $section->title }}</h2> @endif
                         <div class="prose prose-lg mx-auto max-w-4xl text-gray-600">
                             {!! $section->content !!}
                         </div>
                    </div>
                </section>
            @endif
            @break
            
        @default
            {{-- Handle any unknown section types as custom content --}}
            @if($section->content || $section->title)
                <section class="section-padding {{ $section->bg_color ?? 'bg-white' }}">
                    <div class="container-custom">
                         @if($section->title) <h2 class="heading-xl text-center mb-8">{{ $section->title }}</h2> @endif
                         @if($section->content)
                         <div class="prose prose-lg mx-auto max-w-4xl text-gray-600">
                             {!! $section->content !!}
                         </div>
                         @endif
                    </div>
                </section>
            @endif

    @endswitch
@endforeach

@endsection