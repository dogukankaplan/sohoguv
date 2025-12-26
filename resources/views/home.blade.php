@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg">
        @php
            $heroTitle = $hero->title ?? setting('hero_title', 'İzmir <span class="gradient-text">Güvenlik ve Kamera</span> Sistemleri');
            $heroSubtitle = $hero->subtitle ?? setting('hero_subtitle', 'SOHO Güvenlik Sistemleri olarak, İzmir ve Ege bölgesinde kurumsal altyapınızı en üst düzeyde koruyoruz. Profesyonel kamera, alarm ve güvenlik çözümleri.');
            $heroBadge = $hero->badge_text ?? setting('hero_badge', 'İzmir\'in En Güvenilir Güvenlik Çözümü');
            $heroCtaText = $hero->cta_text ?? setting('btn_explore', 'İzmir Güvenlik Hizmetleri');
            $heroCtaUrl = $hero->cta_url ?? '#services';
            $heroBg = $hero && $hero->background_image ? Storage::url($hero->background_image) : null;
        @endphp

        {{-- Hero Section --}}
        <section
            class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-white via-secondary-50/30 to-accent-50/20">
            {{-- Animated Background Elements --}}
            <div class="absolute inset-0 overflow-hidden">
                {{-- Floating Shapes --}}
                <div class="absolute top-20 right-10 w-72 h-72 bg-secondary-500/10 rounded-full blur-3xl animate-pulse"
                    style="animation-duration: 4s;"></div>
                <div class="absolute bottom-20 left-10 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl animate-pulse"
                    style="animation-duration: 6s; animation-delay: 1s;"></div>

                {{-- Grid Pattern --}}
                <div class="absolute inset-0 opacity-[0.03]"
                    style="background-image: linear-gradient(#0A1628 1px, transparent 1px), linear-gradient(90deg, #0A1628 1px, transparent 1px); background-size: 50px 50px;">
                </div>

                {{-- Geometric Accents --}}
                <div class="absolute top-1/4 right-1/4 w-64 h-64 border-2 border-secondary-500/20 rounded-lg rotate-12 animate-spin"
                    style="animation-duration: 20s;"></div>
                <div class="absolute bottom-1/3 left-1/3 w-48 h-48 border-2 border-accent-500/20 rounded-full animate-ping"
                    style="animation-duration: 3s;"></div>
            </div>

            <div class="container-custom relative z-10 py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    {{-- Left Content --}}
                    <div class="space-y-8">
                        {{-- Trust Badge --}}
                        <div
                            class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white shadow-soft border border-secondary-100 animate-fade-in">
                            <div class="relative flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-secondary-500"></span>
                            </div>
                            <span class="text-sm font-bold text-primary-500">{!! $heroBadge !!}</span>
                            <svg class="w-4 h-4 text-secondary-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        {{-- Main Heading --}}
                        <h1
                            class="text-5xl md:text-6xl lg:text-7xl font-black leading-tight text-primary-500 animate-slide-up">
                            {!! $heroTitle !!}
                        </h1>

                        {{-- Subtitle --}}
                        <p
                            class="text-lg md:text-xl text-neutral-medium leading-relaxed max-w-xl animate-slide-up animate-delay-100">
                            {!! $heroSubtitle !!}
                        </p>

                        {{-- CTA Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animate-delay-200">
                            <a href="{{ $heroCtaUrl }}"
                                class="group btn-primary text-lg px-8 py-4 relative overflow-hidden">
                                <span class="relative z-10 flex items-center gap-2">
                                    {{ $heroCtaText }}
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </a>
                            <a href="{{ route('contact') }}"
                                class="group btn-outline text-lg px-8 py-4 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Bize Ulaşın
                            </a>
                        </div>

                        {{-- Trust Indicators --}}
                        <div
                            class="flex flex-wrap items-center gap-8 pt-8 border-t border-neutral-light animate-fade-in animate-delay-300">
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-secondary-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-primary-500">5.0 Müşteri Memnuniyeti</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span class="text-sm font-semibold text-primary-500">ISO 9001 Sertifikalı</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-secondary-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-semibold text-primary-500">7/24 Destek</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right Visual --}}
                    <div class="relative lg:block hidden animate-fade-in animate-delay-200">
                        {{-- Main Card --}}
                        <div class="relative">
                            {{-- Security Dashboard Mockup --}}
                            <div class="bg-white rounded-2xl shadow-strong p-8 border border-neutral-light">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-secondary-500 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-primary-500">Güvenlik Durumu</div>
                                            <div class="text-xs text-neutral-medium">Tüm sistemler aktif</div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 border border-green-200">
                                        <span class="flex h-2 w-2 rounded-full bg-green-500"></span>
                                        <span class="text-xs font-bold text-green-700">Güvenli</span>
                                    </div>
                                </div>

                                {{-- Stats Grid --}}
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div class="p-4 rounded-xl bg-secondary-50 border border-secondary-100">
                                        <div class="text-3xl font-bold text-secondary-500 mb-1">24</div>
                                        <div class="text-xs text-neutral-medium">Aktif Kamera</div>
                                    </div>
                                    <div class="p-4 rounded-xl bg-accent-50 border border-accent-100">
                                        <div class="text-3xl font-bold text-accent-500 mb-1">100%</div>
                                        <div class="text-xs text-neutral-medium">Sistem Sağlığı</div>
                                    </div>
                                </div>

                                {{-- Activity List --}}
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 rounded-lg bg-neutral-bg">
                                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                        <div class="flex-1 text-sm text-primary-500">Alarm sistemi aktif</div>
                                        <div class="text-xs text-neutral-medium">2 dk önce</div>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 rounded-lg bg-neutral-bg">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        <div class="flex-1 text-sm text-primary-500">Kamera kaydı başladı</div>
                                        <div class="text-xs text-neutral-medium">5 dk önce</div>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 rounded-lg bg-neutral-bg">
                                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                        <div class="flex-1 text-sm text-primary-500">Sistem kontrolü tamamlandı</div>
                                        <div class="text-xs text-neutral-medium">15 dk önce</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Floating Elements --}}
                            <div class="absolute -top-6 -right-6 bg-white rounded-xl shadow-medium p-4 border border-neutral-light animate-bounce"
                                style="animation-duration: 3s;">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-bold text-primary-500">Korumalı</span>
                                </div>
                            </div>

                            <div
                                class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-medium p-4 border border-neutral-light">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-secondary-500 to-accent-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-neutral-medium">Hızlı Müdahale</div>
                                        <div class="text-sm font-bold text-primary-500">&lt; 5 dakika</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Scroll Indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
                <div class="flex flex-col items-center gap-2">
                    <span class="text-xs font-semibold text-neutral-medium">Keşfetmeye Devam Edin</span>
                    <svg class="w-6 h-6 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </section>

        {{-- Stats Section --}}
        @if(isset($stats) && count($stats) > 0)
            <section class="section-padding bg-primary-500">
                <div class="container-custom">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach($stats as $stat)
                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $stat->value }}</div>
                                <div class="text-sm text-primary-100">{{ $stat->label }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Why SOHO Features --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="max-w-2xl mx-auto text-center mb-16">
                    <h2 class="text-sm font-bold text-secondary-500 uppercase tracking-wider mb-3">
                        {{ setting('why_soho_subtitle', 'Neden SOHO Güvenlik?') }}
                    </h2>
                    <h3 class="heading-lg mb-4">
                        {{ setting('why_soho_title', 'İzmir\'de Güvenlik Standartlarını Belirliyoruz') }}
                    </h3>
                    <p class="text-body">
                        {{ setting('why_soho_desc', 'İzmir güvenlik sistemleri sektöründe, sıradan çözümlerin ötesine geçerek işletmeniz için en verimli kamera ve alarm sistemlerini sunuyoruz.') }}
                    </p>
                </div>

                @if(isset($whySohoFeatures) && count($whySohoFeatures) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach($whySohoFeatures as $feature)
                            <div class="card p-6 text-center hover-lift">
                                <div class="w-16 h-16 mx-auto mb-4 rounded-lg bg-secondary-50 flex items-center justify-center">
                                    @if($feature->icon)
                                        <x-icon name="{{ $feature->icon }}" class="h-8 w-8 text-secondary-500" />
                                    @endif
                                </div>
                                <h4 class="text-xl font-bold text-primary-500 mb-2">{{ $feature->title }}</h4>
                                <p class="text-neutral-medium text-sm">{{ $feature->description }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- Services Section --}}
        <section id="services" class="section-padding bg-neutral-bg">
            <div class="container-custom">
                <div class="max-w-2xl mx-auto text-center mb-16">
                    <h2 class="text-sm font-bold text-accent-500 uppercase tracking-wider mb-3">
                        {{ setting('services_subtitle', 'İzmir Güvenlik Hizmetleri') }}
                    </h2>
                    <h3 class="heading-lg">
                        {{ setting('services_title', 'Uçtan Uca Kamera ve Güvenlik Çözümleri') }}
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="card-hover p-8 group">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-secondary-50 group-hover:bg-secondary-500 flex items-center justify-center transition-colors duration-300">
                                    @if($service->icon)
                                        <x-icon name="{{ $service->icon }}"
                                            class="h-6 w-6 text-secondary-500 group-hover:text-white transition-colors" />
                                    @else
                                        <svg class="h-6 w-6 text-secondary-500 group-hover:text-white transition-colors" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="text-xl font-bold text-primary-500 group-hover:text-secondary-500 transition-colors">
                                    {{ $service->title }}
                                </h4>
                            </div>
                            <p class="text-neutral-medium text-sm line-clamp-3">
                                {{ Str::limit(strip_tags($service->description), 120) }}
                            </p>
                        </a>
                    @empty
                        <div class="col-span-3 text-center text-neutral-medium italic">
                            {{ setting('msg_no_services', 'Henüz hizmet eklenmemiş.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Why Us Section --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="heading-lg mb-6">
                            {{ setting('why_us_title', 'Neden SOHO Güvenlik İzmir?') }}
                        </h2>
                        <p class="text-body mb-8">
                            {{ setting('why_us_desc', 'İzmir\'deki tecrübemiz ve uzman teknik ekibimizle güvenlik kamerası ve alarm sistemlerinizi en üst seviyeye taşıyoruz. Profesyonel kurulum ve satış sonrası destek.') }}
                        </p>

                        @if(isset($whyUsFeatures) && count($whyUsFeatures) > 0)
                            <div class="space-y-6">
                                @foreach($whyUsFeatures as $feature)
                                    <div class="flex gap-4">
                                        <div
                                            class="flex-shrink-0 w-12 h-12 rounded-lg bg-accent-50 flex items-center justify-center">
                                            @if($feature->icon)
                                                <x-icon name="{{ $feature->icon }}" class="h-6 w-6 text-accent-500" />
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-primary-500 mb-1">{{ $feature->title }}</h4>
                                            <p class="text-neutral-medium text-sm">{{ $feature->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-8">
                            <a href="{{ route('contact') }}" class="btn-accent">
                                {{ setting('btn_contact', 'İletişime Geç') }}
                            </a>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="aspect-square rounded-lg bg-gradient-to-br from-secondary-100 to-accent-100 flex items-center justify-center">
                            <svg class="w-64 h-64 text-white opacity-20" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Clients Section --}}
        <section class="section-padding bg-neutral-bg">
            <div class="container-custom">
                <h2 class="text-center heading-md mb-12">
                    {{ setting('references_title', 'Referanslarımız') }}
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                    @forelse($clients as $client)
                        @if($client->logo)
                            <div class="card p-6 flex items-center justify-center hover-lift">
                                <img class="max-h-12 w-full object-contain grayscale hover:grayscale-0 transition-all duration-300"
                                    src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}">
                            </div>
                        @else
                            <div class="card p-6 flex items-center justify-center">
                                <span class="text-neutral-medium font-semibold text-sm">{{ $client->name }}</span>
                            </div>
                        @endif
                    @empty
                        <div class="col-span-full text-center text-neutral-medium text-sm">
                            {{ setting('msg_no_clients', 'Henüz referans eklenmemiş.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="section-padding bg-primary-500 text-white">
            <div class="container-custom">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        {{ setting('cta_title', 'Güvenliğiniz İçin Harekete Geçin') }}
                    </h2>
                    <p class="text-lg text-primary-100 mb-10 max-w-2xl mx-auto">
                        {{ setting('cta_desc', 'Uzman ekibimizle iletişime geçin, size en uygun güvenlik çözümünü birlikte planlayalım.') }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('requests.fault') }}" class="btn-accent">
                            {{ setting('btn_quote', 'Teklif Al') }}
                        </a>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-500 transition-all duration-200">
                            {{ setting('btn_contact', 'Bize Ulaşın') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection