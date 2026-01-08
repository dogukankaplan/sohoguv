@extends('layouts.app')

@section('content')

{{-- Modern Slider Section --}}
{{-- ULTRA PREMIUM SLIDER SECTION --}}
@if($sliders->isNotEmpty())
<div x-data="{
    currentSlide: 0,
    slides: {{ $sliders->count() }},
    autoplay: true,
    interval: null,
    init() {
        if (this.autoplay) this.startAutoplay();
        // Preload images
        @foreach($sliders as $slider)
            new Image().src = '{{ Storage::url($slider->image) }}';
        @endforeach
    },
    startAutoplay() {
        this.interval = setInterval(() => {
            this.next();
        }, 7000); // 7 seconds per slide
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
class="relative min-h-screen flex items-center justify-center overflow-hidden bg-black group">

    {{-- Slides Container --}}
    @foreach($sliders as $index => $slider)
    <div x-show="currentSlide === {{ $index }}"
         x-transition:enter="transition ease-in-out duration-1000"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in-out duration-1000"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute inset-0 z-0">
        
        {{-- Background Image with Ken Burns Effect --}}
        <div class="absolute inset-0 overflow-hidden">
            @if($slider->image)
            <img src="{{ Storage::url($slider->image) }}" 
                 alt="{{ $slider->title }}"
                 class="w-full h-full object-cover transform origin-center transition-transform duration-[7000ms] ease-linear"
                 :class="currentSlide === {{ $index }} ? 'scale-110' : 'scale-100'">
            @else
            <div class="w-full h-full bg-gradient-to-br from-slate-900 to-black"></div>
            @endif
            
            {{-- Cinematic Overlays --}}
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
        </div>

        {{-- Slide Content --}}
        <div class="absolute inset-0 flex items-center justify-center z-10 px-4">
            <div class="container-custom flex flex-col items-center text-center mt-16 sm:mt-0">
                
                {{-- Badge/Subtitle --}}
                @if($slider->subtitle)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700 delay-300"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/5 backdrop-blur-xl border border-white/10 text-white font-medium mb-8">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="tracking-wide text-sm uppercase">{{ $slider->subtitle }}</span>
                </div>
                @endif

                {{-- Main Title --}}
                <h1 x-show="currentSlide === {{ $index }}"
                    x-transition:enter="transition ease-out duration-700 delay-500"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="text-5xl md:text-7xl lg:text-8xl font-black text-white tracking-tighter leading-[1.1] mb-8 drop-shadow-2xl max-w-5xl">
                    {{ $slider->title }}
                </h1>

                {{-- Description --}}
                @if($slider->description)
                <p x-show="currentSlide === {{ $index }}"
                   x-transition:enter="transition ease-out duration-700 delay-700"
                   x-transition:enter-start="opacity-0 translate-y-8"
                   x-transition:enter-end="opacity-100 translate-y-0"
                   class="text-xl md:text-2xl text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed font-light">
                    {{ $slider->description }}
                </p>
                @endif

                {{-- CTA Button --}}
                @if($slider->button_text && $slider->button_link)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700 delay-1000"
                     x-transition:enter-start="opacity-0 translate-y-8"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <a href="{{ $slider->button_link }}" 
                       class="group relative px-8 py-5 rounded-2xl bg-brand-600 text-white font-bold text-lg overflow-hidden shadow-2xl hover:scale-105 transition-all">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="relative flex items-center gap-2">
                            {{ $slider->button_text }}
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    {{-- Navigation Arrows --}}
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 w-14 h-14 hidden md:flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 backdrop-blur-md border border-white/10 text-white transition-all hover:scale-110 z-20 group">
        <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 hidden md:flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 backdrop-blur-md border border-white/10 text-white transition-all hover:scale-110 z-20 group">
        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>

    {{-- Indicators --}}
    <div class="absolute bottom-32 sm:bottom-24 left-1/2 -translate-x-1/2 flex gap-3 z-20">
        @foreach($sliders as $index => $slider)
        <button @click="goTo({{ $index }})" 
                class="transition-all duration-500 rounded-full h-1.5"
                :class="currentSlide === {{ $index }} ? 'w-12 bg-brand-500' : 'w-4 bg-white/30 hover:bg-white/50'">
        </button>
        @endforeach
    </div>

    {{-- Tech Strip at Bottom (Consistent) --}}
    <div class="absolute bottom-0 left-0 right-0 border-t border-white/5 bg-black/40 backdrop-blur-md py-4 sm:py-6 overflow-hidden z-20">
        <div class="flex flex-wrap justify-center gap-6 sm:gap-12 px-4">
             <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-brand-500"></span> 7/24 İzleme</div>
             <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-cyan-500"></span> AI Analiz</div>
             <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Bulut</div>
             <div class="hidden sm:flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Mobil</div>
        </div>
    </div>

</div>
@endif

@foreach($sections as $section)
    @switch($section->type)
        @case('hero')
            {{-- ULTRA PREMIUM HERO SECTION - REDESIGNED --}}
            {{-- Only show if Sliders are empty (Fallback) --}}
            @if($sliders->isEmpty())
            <div class="relative min-h-screen flex items-center justify-center overflow-hidden group">
                
                {{-- 1. Background Image Wrapper --}}
                <div class="absolute inset-0 z-0">
                    {{-- Priority: Main Image -> Settings BG Image -> Gradient Fallback --}}
                    @if($section->image)
                        <img src="{{ Storage::url($section->image) }}" 
                             alt="Hero Background" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[30s] ease-linear">
                    @elseif(isset($section->settings['bg_image']) && $section->settings['bg_image'])
                        <img src="{{ Storage::url($section->settings['bg_image']) }}" 
                             alt="Hero Background" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[30s] ease-linear">
                    @else
                        {{-- Fallback Gradient --}}
                        <div class="w-full h-full bg-gradient-to-br from-slate-900 via-slate-800 to-black"></div>
                    @endif
                    
                    {{-- Cinematic Overlay: Stronger darkness for text readability --}}
                    <div class="absolute inset-0 bg-black/60"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    
                    {{-- Texture --}}
                    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay"></div>
                </div>

                {{-- 2. Content Container --}}
                <div class="container-custom relative z-10 px-4 h-full flex flex-col justify-center items-center text-center mt-16 sm:mt-0">
                    
                    {{-- Animated Badge --}}
                    <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/5 backdrop-blur-xl border border-white/10 text-white font-medium mb-10 animate-fade-in-down shadow-2xl ring-1 ring-white/20">
                        <div class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </div>
                        <span class="tracking-wide text-sm uppercase">Güvenlikte Yeni Standart</span>
                    </div>

                    {{-- Main Headline --}}
                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white tracking-tighter leading-[1.1] mb-8 drop-shadow-2xl animate-title max-w-5xl">
                        {{ $section->title ?? setting('hero_title', 'Güvenliğiniz,') }}
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-brand-400 via-cyan-400 to-emerald-400 bg-300% animate-gradient">
                             Bizim İşimiz
                        </span>
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-xl md:text-2xl text-slate-300 mb-12 max-w-3xl mx-auto leading-relaxed font-light animate-fade-in-up" style="animation-delay: 0.2s">
                        {{ $section->subtitle ?? setting('hero_subtitle', 'Yeni nesil güvenlik teknolojileri ve yapay zeka destekli izleme sistemleri ile 7/24 tam koruma.') }}
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-5 w-full sm:w-auto animate-fade-in-up" style="animation-delay: 0.4s">
                        <a href="{{ route('contact') }}" class="group relative px-8 py-5 rounded-2xl bg-brand-600 text-white font-bold text-lg overflow-hidden shadow-[0_0_40px_-10px_rgba(37,99,235,0.5)] transition-all hover:scale-105 w-full sm:w-auto">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="relative flex items-center justify-center gap-2">
                                Ücretsiz Keşif İste
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </span>
                        </a>
                        <a href="{{ route('services.index') }}" class="group px-8 py-5 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 text-white font-bold text-lg hover:bg-white/10 transition-all hover:scale-105 w-full sm:w-auto">
                            <span class="flex items-center justify-center gap-2">
                                Çözümlerimiz
                                <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="absolute bottom-24 left-1/2 -translate-x-1/2 animate-bounce opacity-50">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>

                {{-- Tech Strip at Bottom --}}
                <div class="absolute bottom-0 left-0 right-0 border-t border-white/5 bg-black/40 backdrop-blur-md py-4 sm:py-6 overflow-hidden z-20">
                    <div class="flex flex-wrap justify-center gap-6 sm:gap-12 px-4">
                         <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-brand-500"></span> 7/24 İzleme</div>
                         <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-cyan-500"></span> AI Analiz</div>
                         <div class="flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Bulut</div>
                         <div class="hidden sm:flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Mobil</div>
                         <div class="hidden sm:flex items-center gap-2 text-white/80 font-mono text-xs sm:text-sm uppercase tracking-widest"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Teknik Destek</div>
                    </div>
                </div>
            </div>
            @endif
            @break

        @case('stats')
            {{-- Stats Section --}}
            <div class="py-12 bg-gray-50 border-y border-gray-100">
                <div class="container-custom">
                    <div class="grid grid-cols-2 md:grid-cols-4 md:divide-x divide-gray-200/50">
                        @php
                            $stats = [
                                ['value' => setting('stat_1_value', '15+'), 'label' => setting('stat_1_label', 'Yıllık Tecrübe')],
                                ['value' => setting('stat_2_value', '1000+'), 'label' => setting('stat_2_label', 'Mutlu Müşteri')],
                                ['value' => setting('stat_3_value', '50+'), 'label' => setting('stat_3_label', 'Uzman Personel')],
                                ['value' => setting('stat_4_value', '81'), 'label' => setting('stat_4_label', 'İlde Hizmet')],
                            ];
                        @endphp
                        @foreach($stats as $stat)
                        <div class="text-center px-4 py-6 md:py-0 group">
                            <div class="stat-number text-3xl md:text-4xl lg:text-5xl group-hover:scale-110 transition-transform duration-300">{{ $stat['value'] }}</div>
                            <div class="stat-label text-sm md:text-base">{{ $stat['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @break

        @case('services')
            {{-- Akıllı Çözümlerimiz - Expert Redesign --}}
            <section class="relative py-20 lg:py-32 overflow-hidden bg-gradient-to-br from-white via-slate-50/50 to-white">
                {{-- Background Elements --}}
                <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-br from-brand-100/20 to-transparent rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-gradient-to-tr from-accent-100/20 to-transparent rounded-full blur-3xl"></div>

                <div class="container-custom relative z-10">
                    {{-- Section Header --}}
                    <div class="max-w-3xl mx-auto text-center mb-16 lg:mb-20">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium mb-6">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>Çözümlerimiz</span>
                        </div>
                        
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6">
                            <span class="bg-gradient-to-r from-brand-600 via-accent-600 to-brand-700 bg-clip-text text-transparent">
                                Akıllı Güvenlik
                            </span>
                            <span class="block text-slate-900 mt-2">Çözümleri</span>
                        </h2>
                        
                        <p class="text-lg lg:text-xl text-slate-600 leading-relaxed">
                            İşletmeniz ve eviniz için en uygun, ölçeklenebilir ve güvenilir teknoloji altyapıları
                        </p>
                    </div>

                    {{-- Services Bento Grid --}}
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                        @foreach($services as $index => $service)
                        @php
                            $colors = [
                                ['from' => 'brand-500', 'to' => 'brand-700', 'accent' => 'brand'],
                                ['from' => 'accent-500', 'to' => 'accent-700', 'accent' => 'accent'],
                                ['from' => 'amber-500', 'to' => 'amber-700', 'accent' => 'amber'],
                                ['from' => 'brand-600', 'to' => 'accent-600', 'accent' => 'brand'],
                                ['from' => 'accent-600', 'to' => 'brand-600', 'accent' => 'accent'],
                                ['from' => 'amber-600', 'to' => 'brand-600', 'accent' => 'amber'],
                            ];
                            $color = $colors[$index % 6];
                        @endphp
                        
                        <div class="group relative bg-white rounded-3xl border border-slate-200 hover:border-{{ $color['accent'] }}-300 transition-all duration-300 overflow-hidden hover:shadow-2xl hover:shadow-{{ $color['accent'] }}-500/10">
                            {{-- Gradient Overlay on Hover --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-{{ $color['from'] }}/0 to-{{ $color['to'] }}/0 group-hover:from-{{ $color['from'] }}/5 group-hover:to-{{ $color['to'] }}/5 transition-all duration-500"></div>
                            
                            <div class="relative p-6 lg:p-8">
                                {{-- Icon Badge --}}
                                <div class="relative mb-6">
                                    <div class="absolute inset-0 bg-gradient-to-br from-{{ $color['from'] }} to-{{ $color['to'] }} rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                    <div class="relative w-14 h-14 lg:w-16 lg:h-16 rounded-2xl bg-gradient-to-br from-{{ $color['from'] }}/10 to-{{ $color['to'] }}/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        @if($service->image)
                                        <img src="{{ Storage::url($service->image) }}" class="w-8 h-8 lg:w-10 lg:h-10 opacity-70 group-hover:opacity-100 transition-opacity" alt="{{ $service->title }}">
                                        @else
                                        <svg class="w-8 h-8 lg:w-10 lg:h-10 text-{{ $color['accent'] }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                {{-- Title --}}
                                <h3 class="text-xl lg:text-2xl font-bold text-slate-900 mb-3 group-hover:text-{{ $color['accent'] }}-600 transition-colors">
                                    {{ $service->title }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-slate-600 text-sm lg:text-base mb-6 leading-relaxed line-clamp-3">
                                    {{ Str::limit(strip_tags($service->content), 120) }}
                                </p>

                                {{-- CTA Link --}}
                                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-{{ $color['accent'] }}-600 font-semibold text-sm group-hover:gap-3 transition-all">
                                    <span>Detaylı İncele</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>

                                {{-- Hover Indicator --}}
                                <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-{{ $color['accent'] }}-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Bottom CTA --}}
                    <div class="mt-12 lg:mt-16 text-center">
                        <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition-all shadow-lg hover:shadow-xl hover:shadow-slate-900/20">
                            <span>Tüm Çözümleri Görüntüle</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
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
                                    $whySohoFeatures = $features->where('section', 'why_soho');
                                    if($whySohoFeatures->isEmpty()) {
                                        $whySohoFeatures = collect([
                                            ['title' => 'Ulusal Hizmet Ağı', 'description' => 'Türkiye\'nin 81 ilinde kurulum ve teknik servis desteği.'],
                                            ['title' => 'Garantili İşçilik', 'description' => 'Yapılan tüm montaj ve kurulumlarımız firma garantisi altındadır.'],
                                            ['title' => 'Hızlı Müdahale', 'description' => 'Arıza durumunda 24 saat içerisinde teknik ekip yönlendirmesi.'],
                                        ]);
                                    }
                                @endphp
                                @foreach($whySohoFeatures as $feature)
                                <div class="flex gap-6 group">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white shadow-soft flex items-center justify-center border border-gray-100 group-hover:border-brand-200 transition-colors">
                                        <svg class="w-6 h-6 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h4>
                                        <div class="text-gray-600 prose prose-sm max-w-none">{!! $feature['description'] !!}</div>
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
                                        <div class="text-4xl font-bold text-accent-500 mb-2">20+</div>
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
            {{-- Clients Section - Premium Design --}}
            <section class="py-24 bg-white border-t border-slate-100">
                <div class="container-custom">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-wider mb-4">
                            Güçlü Referanslar
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">Güvenle <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-accent-600">Hizmet Verdiğimiz</span> Markalar</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-8">
                         @foreach($clients as $index => $client)
                            <div class="group relative bg-white p-4 md:p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-brand-500/5 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center h-24 md:h-40"
                                 style="animation-delay: {{ $index * 0.05 }}s;">
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="relative z-10 max-h-16 md:max-h-20 w-auto grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition duration-500 transform group-hover:scale-110">
                                @else
                                    <span class="relative z-10 text-lg font-bold text-slate-400 group-hover:text-brand-600 transition">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                        {{-- Fallback if no clients --}}
                        @if($clients->isEmpty())
                            <div class="col-span-full text-center py-12">
                                <div class="inline-block px-6 py-4 rounded-2xl bg-slate-50 border border-dashed border-slate-300 text-slate-400 italic">
                                    Referans logoları eklenecek...
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
            @break
            
        @case('partners')
            {{-- Partners Section - Premium Light Design --}}
            <section class="py-24 bg-slate-50 relative overflow-hidden">
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
                
                <div class="container-custom relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-xs font-bold uppercase tracking-wider mb-4">
                            Güçlü İş Birlikleri
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 tracking-tight">Değerli <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-accent-600">Partnerlerimiz</span></h2>
                        <p class="text-lg text-slate-600 leading-relaxed">Projelerimizde en kaliteli ürünleri ve teknolojileri kullanmak için sektörün lider markalarıyla çalışıyoruz.</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 lg:gap-8">
                        @foreach($partners as $partner)
                        <div class="group relative bg-white p-4 md:p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 transition-all duration-300 flex items-center justify-center h-20 sm:h-32">
                            <div class="absolute top-2 right-2 w-1.5 h-1.5 rounded-full bg-brand-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <img src="{{ Storage::url($partner->logo) }}" 
                                 alt="{{ $partner->name }}" 
                                 class="relative z-10 max-h-12 sm:max-h-16 w-auto grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110">
                        </div>
                        @endforeach
                        @if($partners->isEmpty())
                        <div class="col-span-full py-12 text-center text-slate-400 italic">
                            Partner logoları güncelleniyor...
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            @break

        @case('solution_partners')
            {{-- Solution Partners Section - Premium Interactive Cards --}}
            <section class="py-24 bg-white relative overflow-hidden">
                {{-- Decorative Blobs --}}
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent-50/50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-brand-50/50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

                <div class="container-custom relative z-10">
                    <div class="text-center mb-16">
                         <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider mb-4">
                            Global Teknolojiler
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Global <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-600 to-brand-600">Çözüm Ortaklarımız</span></h2>
                        <p class="text-lg text-slate-600 max-w-2xl mx-auto">Dünya standartlarında güvenlik teknolojilerini sizin için bir araya getiriyoruz.</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                        @foreach($solutionPartners as $sp)
                        <div class="group relative bg-white rounded-3xl p-4 md:p-8 border border-slate-100 hover:border-brand-100 transition-all duration-300 hover:shadow-2xl hover:shadow-brand-900/5 min-h-[120px] md:min-h-[160px] flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-br from-transparent to-slate-50/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl pointer-events-none"></div>
                            <div class="relative z-10 flex items-center justify-center">
                                <img src="{{ Storage::url($sp->logo) }}" 
                                     alt="{{ $sp->name }}" 
                                     class="max-h-16 w-auto grayscale group-hover:grayscale-0 opacity-70 group-hover:opacity-100 transition-all duration-500 group-hover:scale-110">
                            </div>
                        </div>
                        @endforeach
                        @if($solutionPartners->isEmpty())
                        <div class="col-span-full py-12 text-center text-slate-400 italic">
                            Çözüm ortağı verileri yükleniyor...
                        </div>
                        @endif
                    </div>
                </div>
            </section>
            @break

        @case('video')
            {{-- Video Section --}}
            <section class="py-24 bg-slate-900 relative overflow-hidden">
                {{-- Background Pattern --}}
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-900/90 to-slate-900"></div>
                
                {{-- Glow Effects --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-brand-500/10 rounded-full blur-[120px] pointer-events-none"></div>

                <div class="container-custom relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        @if($section->subtitle)
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white/80 text-xs font-bold uppercase tracking-wider mb-4 animate-fade-in">
                            {{ $section->subtitle }}
                        </div>
                        @endif
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 tracking-tight animate-slide-up">
                            {{ $section->title ?? 'Tanıtım Videomuz' }}
                        </h2>
                        @if($section->content_rich)
                             <div class="text-lg text-slate-400 max-w-2xl mx-auto prose prose-invert animate-slide-up" style="animation-delay: 0.1s;">
                                 {!! $section->content_rich !!}
                             </div>
                        @endif
                    </div>

                    {{-- Dynamic Video Container --}}
                    @php
                        $videoUrl = $section->content; // Content holds the URL
                        $videoId = '';
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoUrl, $match)) {
                            $videoId = $match[1];
                        }
                    @endphp

                    <div class="relative max-w-5xl mx-auto animate-scale-in" style="animation-delay: 0.2s;">
                        {{-- Video Frame --}}
                        <div class="relative bg-slate-800 rounded-3xl overflow-hidden shadow-2xl border border-white/10 aspect-video group">
                            @if($videoId)
                                <iframe class="absolute inset-0 w-full h-full" 
                                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1" 
                                        title="{{ $section->title }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                            @else
                                {{-- Placeholder if no valid URL --}}
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-800 text-slate-500">
                                    <svg class="w-16 h-16 mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8zm2 3h6v4H7v-4z" />
                                    </svg>
                                    <span>Video URL girilmedi veya geçersiz (Youtube)</span>
                                </div>
                            @endif
                        </div>

                        {{-- Decorative Elements --}}
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-brand-500 to-accent-500 rounded-full blur-2xl opacity-40 -z-10 animate-pulse"></div>
                        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-gradient-to-tr from-accent-500 to-brand-500 rounded-full blur-2xl opacity-40 -z-10 animate-pulse" style="animation-delay: 1s;"></div>
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
                            <p class="text-gray-600 mb-6 italic">"{!! $testimonial->content !!}"</p>
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