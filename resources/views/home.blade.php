@extends('layouts.app')

@section('content')
    <div class="bg-white">
        @php
            $heroTitle = $hero->title ?? setting('hero_title', 'Türkiye\'nin Güvenlik Sistemleri Lideri');
            $heroSubtitle = $hero->subtitle ?? setting('hero_subtitle', 'Ev ve iş yerleriniz için son teknoloji güvenlik çözümleri sunuyoruz. Kamera sistemleri, alarm sistemleri ve daha fazlası.');
            $heroCtaText = $hero->cta_text ?? setting('hero_cta', 'Ücretsiz Keşif Alın');
            $heroCtaUrl = $hero->cta_url ?? '#contact';
        @endphp

        {{-- Hero Section --}}
        <section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-subtle">
            {{-- Animated Background Elements --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div
                    class="absolute top-20 right-20 w-96 h-96 bg-gradient-to-br from-cyan-100 to-purple-100 rounded-full opacity-50 blur-3xl animate-float">
                </div>
                <div class="absolute bottom-20 left-20 w-80 h-80 bg-gradient-to-br from-magenta-100 to-cyan-100 rounded-full opacity-40 blur-3xl animate-float"
                    style="animation-delay: 1s;"></div>
            </div>

            <div class="container-custom relative z-10 py-20">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    {{-- Left Content --}}
                    <div class="space-y-8 animate-fade-in">
                        {{-- Trust Badge --}}
                        <div
                            class="inline-flex items-center gap-3 px-6 py-3 rounded-pill bg-white shadow-soft border border-gray-200">
                            <div class="w-2 h-2 rounded-full bg-gradient-to-r from-cyan-500 to-green-500 animate-ping">
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Türkiye Geneli Hizmet</span>
                        </div>

                        {{-- Main Heading --}}
                        <h1 class="heading-hero-xl leading-none">
                            {!! str_replace(
        ['Türkiye', 'Güvenlik', 'Lideri'],
        [
            '<span class="text-gradient">Türkiye</span>',
            '<span class="text-gradient">Güvenlik</span>',
            '<span class="text-gray-900">Lideri</span>'
        ],
        $heroTitle
    ) !!}
                        </h1>

                        {{-- Subtitle --}}
                        <p class="text-body-lg max-w-lg">
                            {{ $heroSubtitle }}
                        </p>

                        {{-- CTA Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ $heroCtaUrl }}" class="btn-gradient-primary group">
                                {{ $heroCtaText }}
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                            <a href="{{ route('contact') }}" class="btn-white">
                                İletişime Geç
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                        </div>

                        {{-- Trust Indicators --}}
                        <div class="flex flex-wrap items-center gap-8 pt-8 border-t border-gray-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">5.0 Müşteri Memnuniyeti</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">7/24 Destek</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">Profesyonel Ekip</span>
                            </div>
                        </div>
                    </div>

                    {{-- Right Visual --}}
                    <div class="relative hidden lg:block animate-fade-in animate-delay-200">
                        <div class="relative">
                            {{-- Security Dashboard Mockup --}}
                            <div class="card-modern relative overflow-hidden">
                                {{-- Gradient Border Effect --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 via transparent to-magenta-500/10">
                                </div>

                                <div class="relative p-8">
                                    <div class="flex items-center justify-between mb-6">
                                        <div class="flex items-center gap-3">
                                            <div class="icon-circle-gradient">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path strokeLinecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-900">Güvenlik Kontrolü</h3>
                                                <p class="text-sm text-gray-600">Tüm sistemler aktif</p>
                                            </div>
                                        </div>
                                        <div class="px-4 py-2 rounded-pill bg-green-50 border border-green-200">
                                            <span class="text-sm font-semibold text-green-700">Online</span>
                                        </div>
                                    </div>

                                    {{-- Stats Grid --}}
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="p-4 rounded-2xl bg-gray-50">
                                            <p class="stat-number">24</p>
                                            <p class="stat-label">Kamera</p>
                                        </div>
                                        <div class="p-4 rounded-2xl bg-gray-50">
                                            <p class="stat-number">12</p>
                                            <p class="stat-label">Sensör</p>
                                        </div>
                                        <div class="p-4 rounded-2xl bg-gray-50">
                                            <p class="stat-number">8</p>
                                            <p class="stat-label">Alarm</p>
                                        </div>
                                        <div class="p-4 rounded-2xl bg-gray-50">
                                            <p class="stat-number">100%</p>
                                            <p class="stat-label">Aktif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Floating Elements --}}
                            <div
                                class="absolute -top-8 -right-8 w-24 h-24 bg-gradient-to-br from-cyan-400 to-purple-500 rounded-full opacity-20 blur-2xl animate-float">
                            </div>
                            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-gradient-to-br from-magenta-400 to-cyan-500 rounded-full opacity-20 blur-2xl animate-float"
                                style="animation-delay: 1.2s;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Stats Section --}}
        @if($stats && $stats->count() > 0)
            <section class="section-padding-sm bg-white border-y border-gray-200">
                <div class="container-custom">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach($stats->take(4) as $stat)
                            <div class="text-center">
                                <p class="stat-number">{{ $stat->number }}</p>
                                <p class="stat-label mt-2">{{ $stat->label }}</p>
                            </div>
                            @if(!$loop->last)
                                <div class="hidden md:block w-px bg-gray-200"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Services Section --}}
        <section class="section-padding bg-gray-50">
            <div class="container-custom">
                <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                    <p class="text-sm font-bold text-cyan-600 uppercase tracking-wider">Çözümlerimiz</p>
                    <h2 class="heading-xl">
                        <span class="text-gradient">Güvenlik Sistemleri</span>
                        <span class="block mt-2">Hizmetlerimiz</span>
                    </h2>
                    <p class="text-body">
                        Ev ve iş yerleriniz için kapsamlı güvenlik çözümleri sunuyoruz
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="card-gradient-border hover-lift group">
                            <div class="space-y-4">
                                {{-- Icon --}}
                                <div class="icon-circle-gradient">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                {{-- Title --}}
                                <h3 class="heading-sm group-hover:text-cyan-600 transition">
                                    {{ $service->title }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ Str::limit(strip_tags($service->content), 120) }}
                                </p>

                                {{-- Link --}}
                                <div
                                    class="flex items-center gap-2 text-sm font-semibold text-cyan-600 group-hover:gap-3 transition-all">
                                    Detaylı Bilgi
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why SOHO Section --}}
        @if($whySohoFeatures && $whySohoFeatures->count() > 0)
            <section class="section-padding bg-white">
                <div class="container-custom">
                    <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                        <p class="text-sm font-bold text-magenta-600 uppercase tracking-wider">Neden Biz?</p>
                        <h2 class="heading-xl">
                            SOHO'yu <span class="text-gradient">Tercih Etme</span> Sebepleri
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($whySohoFeatures as $feature)
                            <div class="card-modern text-center">
                                <div class="icon-circle mx-auto mb-6">
                                    <svg class="w-6 h-6 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="heading-sm mb-4">{{ $feature->title }}</h3>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $feature->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Clients Section --}}
        @if($clients && $clients->count() > 0)
            <section class="section-padding-sm bg-gray-50">
                <div class="container-custom">
                    <div class="text-center mb-12">
                        <h2 class="heading-md mb-4">Bize <span class="text-gradient">Güvenen</span> Markalar</h2>
                        <p class="text-body">Türkiye'nin önde gelen firmaları ile çalışıyoruz</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
                        @foreach($clients as $client)
                            <div class="flex items-center justify-center grayscale hover:grayscale-0 transition duration-300">
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-h-16 w-auto opacity-60 hover:opacity-100 transition">
                                @else
                                    <span class="text-lg font-semibold text-gray-400">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- CTA Section --}}
        <section class="section-padding bg-gradient-primary relative overflow-hidden">
            <div
                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00em0wLTEwYzAtMi4yMS0xLjc5LTQtNC00cy00IDEuNzktNCA0IDEuNzkgNCA0IDQgNC0xLjc5IDQtNHptMC0xMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-30">
            </div>

            <div class="container-custom relative z-10">
                <div class="max-w-4xl mx-auto text-center space-y-8">
                    <h2 class="heading-lg text-white">
                        Güvenliğiniz İçin <span class="block mt-2">Hemen Harekete Geçin</span>
                    </h2>
                    <p class="text-body-lg text-white/90">
                        Uzman ekibimiz size özel çözümler sunmaya hazır. Ücretsiz keşif için iletişime geçin.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact') }}" class="btn-white">
                            Ücretsiz Danışmanlık
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="tel:{{ setting('phone', '+90 555 123 45 67') }}"
                            class="btn-outline border-white text-white hover:bg-white/10">
                            {{ setting('phone', '+90 555 123 45 67') }}
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection