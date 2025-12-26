@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg">
        @php
            $heroTitle = $hero->title ?? setting('hero_title', 'Güvenliğiniz Bizim <span class="gradient-text">Önceliğimiz</span>');
            $heroSubtitle = $hero->subtitle ?? setting('hero_subtitle', 'SOHO Güvenlik Sistemleri olarak, kurumsal altyapınızı en üst düzeyde koruyoruz. Teknoloji ve güvenliği bir araya getirerek size huzur sunuyoruz.');
            $heroBadge = $hero->badge_text ?? setting('hero_badge', 'Türkiye\'nin Güvenilir Güvenlik Çözümü');
            $heroCtaText = $hero->cta_text ?? setting('btn_explore', 'Hizmetlerimizi Keşfedin');
            $heroCtaUrl = $hero->cta_url ?? '#services';
            $heroBg = $hero && $hero->background_image ? Storage::url($hero->background_image) : null;
        @endphp

        {{-- Hero Section --}}
        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-white">
            {{-- Geometric Background Pattern --}}
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-20 right-20 w-96 h-96 border-2 border-secondary-500 rounded-full"></div>
                <div class="absolute bottom-20 left-20 w-64 h-64 border-2 border-accent-500 rounded-lg rotate-45"></div>
            </div>

            <div class="container-custom relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-secondary-50 border border-secondary-200 mb-8 animate-fade-in">
                        <span class="flex h-2 w-2 rounded-full bg-secondary-500"></span>
                        <span class="text-sm font-semibold text-secondary-600">{!! $heroBadge !!}</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="heading-xl mb-6 animate-slide-up">
                        {!! $heroTitle !!}
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-body max-w-2xl mx-auto mb-10 animate-slide-up animate-delay-100">
                        {!! $heroSubtitle !!}
                    </p>

                    {{-- CTA Buttons --}}
                    <div
                        class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-slide-up animate-delay-200">
                        <a href="{{ $heroCtaUrl }}" class="btn-primary">
                            {{ $heroCtaText }}
                        </a>
                        <a href="{{ route('contact') }}" class="btn-outline">
                            Bize Ulaşın
                        </a>
                    </div>
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
                        {{ setting('why_soho_subtitle', 'Neden SOHO?') }}
                    </h2>
                    <h3 class="heading-lg mb-4">
                        {{ setting('why_soho_title', 'Güvenlik Standartlarını Yeniden Belirliyoruz') }}
                    </h3>
                    <p class="text-body">
                        {{ setting('why_soho_desc', 'Sıradan güvenlik çözümlerinin ötesine geçerek, işletmeniz için en verimli ve estetik çözümleri sunuyoruz.') }}
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
                        {{ setting('services_subtitle', 'Hizmetlerimiz') }}
                    </h2>
                    <h3 class="heading-lg">
                        {{ setting('services_title', 'Uçtan Uca Çözümler') }}
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
                            {{ setting('why_us_title', 'Neden SOHO?') }}
                        </h2>
                        <p class="text-body mb-8">
                            {{ setting('why_us_desc', 'Tecrübemiz ve uzman ekibimizle güvenliğinizi en üst seviyeye taşıyoruz.') }}
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