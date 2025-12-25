@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden bg-slate-900 text-white selection:bg-soho-teal selection:text-white">
        <!-- Vivid Abstract Background -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
            <div
                class="absolute -top-1/2 -right-1/4 w-[80rem] h-[80rem] rounded-full bg-soho-purple/20 blur-[128px] animate-blob mix-blend-screen">
            </div>
            <div
                class="absolute -bottom-1/2 -left-1/4 w-[80rem] h-[80rem] rounded-full bg-soho-teal/10 blur-[128px] animate-blob animation-delay-4000 mix-blend-screen">
            </div>
        </div>

        @php
            // Fallback values if no hero section is defined
            $heroTitle = $hero->title ?? setting('hero_title', 'Güvenliği <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-soho-teal to-soho-purple">Sanata Dönüştürdük.</span>');
            $heroSubtitle = $hero->subtitle ?? setting('hero_subtitle', 'SOHO, kurumsal altyapınızı sadece korumaz; onu akıllı, yönetilebilir ve estetik bir teknoloji merkezine dönüştürür.');
            $heroBadge = $hero->badge_text ?? setting('hero_badge', 'Yeni Nesil Güvenlik Sistemleri');
            $heroCtaText = $hero->cta_text ?? setting('btn_explore', 'Keşfetmeye Başla');
            $heroCtaUrl = $hero->cta_url ?? '#services';
            $heroBg = $hero && $hero->background_image ? Storage::url($hero->background_image) : null;
        @endphp

        <!-- Hero Section -->
        <div class="relative z-10 pt-32 pb-20 sm:pt-40 sm:pb-24 lg:pb-32" @if($heroBg)
        style="background-image: url('{{ $heroBg }}'); background-size: cover; background-position: center;" @endif>

            @if($heroBg)
                <div class="absolute inset-0 bg-slate-900/80"></div>
            @endif

            <div class="relative mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-8 animate-fade-in-up">
                    <span class="flex h-2 w-2 rounded-full bg-soho-teal animate-pulse"></span>
                    <span class="text-sm font-medium text-slate-300">{!! $heroBadge !!}</span>
                </div>

                <h1
                    class="text-5xl font-black tracking-tight sm:text-7xl lg:text-8xl mb-8 leading-tight animate-fade-in-up animation-delay-100">
                    {!! $heroTitle !!}
                </h1>

                <p
                    class="mt-6 text-lg sm:text-xl leading-8 text-slate-400 max-w-2xl mx-auto font-light animate-fade-in-up animation-delay-200">
                    {!! $heroSubtitle !!}
                </p>

                <div
                    class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6 animate-fade-in-up animation-delay-300">
                    <a href="{{ $heroCtaUrl }}"
                        class="group relative px-8 py-4 bg-white/10 overflow-hidden rounded-full text-white shadow-2xl transition-all hover:bg-white/20 backdrop-blur-sm border border-white/10">
                        <div
                            class="absolute inset-0 w-0 bg-gradient-to-r from-soho-teal to-soho-purple transition-all duration-[250ms] ease-out group-hover:w-full opacity-20">
                        </div>
                        <span
                            class="relative text-sm font-bold uppercase tracking-widest group-hover:tracking-[0.15em] transition-all">
                            {{ $heroCtaText }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Dynamic Stats Section -->
        @if(isset($stats) && count($stats) > 0)
            <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8 -mt-12">
                <div
                    class="grid grid-cols-2 gap-4 rounded-xl bg-white/5 p-4 backdrop-blur-lg sm:grid-cols-4 border border-white/10 shadow-2xl">
                    @foreach($stats as $stat)
                        <div class="flex flex-col items-center justify-center p-4 text-center">
                            <div class="mb-2 text-soho-teal">
                                @if($stat->icon)
                                    <x-icon name="{{ $stat->icon }}" class="w-8 h-8" />
                                @endif
                            </div>
                            <dt class="text-sm leading-6 text-slate-400 font-medium">{{ $stat->label }}</dt>
                            <dd class="order-first text-3xl font-bold tracking-tight text-white">{{ $stat->value }}</dd>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Why SOHO Features Section -->
        <div class="py-24 sm:py-32 relative z-10">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-soho-teal">
                        {{ setting('why_soho_subtitle', 'Neden SOHO?') }}</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        {{ setting('why_soho_title', 'Güvenlik Standartlarını Yeniden Belirliyoruz') }}
                    </p>
                    <p class="mt-6 text-lg leading-8 text-slate-400">
                        {{ setting('why_soho_desc', 'Sıradan güvenlik çözümlerinin ötesine geçerek, işletmeniz için en verimli ve estetik çözümleri sunuyoruz.') }}
                    </p>
                </div>

                @if(isset($whySohoFeatures) && count($whySohoFeatures) > 0)
                    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-4">
                            @foreach($whySohoFeatures as $feature)
                                <div class="flex flex-col items-center text-center group">
                                    <div
                                        class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/5 border border-white/10 group-hover:border-soho-teal/50 group-hover:bg-soho-teal/10 transition-all duration-300">
                                        @if($feature->icon)
                                            <x-icon name="{{ $feature->icon }}"
                                                class="h-8 w-8 text-white group-hover:text-soho-teal transition-colors" />
                                        @endif
                                    </div>
                                    <dt class="text-xl font-bold leading-7 text-white">
                                        {{ $feature->title }}
                                    </dt>
                                    <dd class="mt-1 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                        <p class="flex-auto">{{ $feature->description }}</p>
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif
            </div>
        </div>

        <!-- Services Section -->
        <div id="services" class="py-24 sm:py-32 bg-slate-900/50">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-soho-purple">
                        {{ setting('services_subtitle', 'Hizmetlerimiz') }}</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        {{ setting('services_title', 'Uçtan Uca Çözümler') }}
                    </p>
                </div>
                <div
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-6 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-8">
                    @forelse($services as $service)
                        <div
                            class="relative group rounded-3xl bg-slate-900 border border-white/5 p-8 hover:border-soho-purple/50 transition-all duration-300 hover:shadow-2xl hover:shadow-soho-purple/10">
                            <div class="flex items-center gap-x-4">
                                <span
                                    class="rounded-lg bg-soho-purple/10 p-3 text-soho-purple group-hover:text-white group-hover:bg-soho-purple transition-colors">
                                    @if($service->icon)
                                        <x-icon name="{{ $service->icon }}" class="h-6 w-6" />
                                    @else
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @endif
                                </span>
                                <h3
                                    class="text-lg font-semibold leading-8 text-white group-hover:text-soho-purple transition-colors">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $service->title }}
                                    </a>
                                </h3>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-400 line-clamp-3">
                                {{ Str::limit(strip_tags($service->description), 120) }}
                            </p>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-slate-500 italic">
                            {{ setting('msg_no_services', 'Henüz hizmet eklenmemiş.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Why Us (Neden Biz) -->
        <div class="relative isolate overflow-hidden bg-slate-900 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                        {{ setting('why_us_title', 'Neden SOHO?') }}</h2>
                    <p class="mt-6 text-lg leading-8 text-slate-300">
                        {{ setting('why_us_desc', 'Tecrübemiz ve uzman ekibimizle güvenliğinizi en üst seviyeye taşıyoruz.') }}
                    </p>
                </div>

                @if(isset($whyUsFeatures) && count($whyUsFeatures) > 0)
                    <div class="mx-auto mt-16 max-w-2xl lg:mx-0 lg:max-w-none">
                        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-3">
                            @foreach($whyUsFeatures as $feature)
                                <div
                                    class="flex flex-col gap-y-4 border-l pl-6 border-white/10 hover:border-soho-teal transition-colors duration-300">
                                    <dt class="text-lg leading-7 font-bold text-white flex items-center gap-2">
                                        @if($feature->icon)
                                            <x-icon name="{{ $feature->icon }}" class="h-5 w-5 text-soho-teal" />
                                        @endif
                                        {{ $feature->title }}
                                    </dt>
                                    <dd class="text-base leading-7 text-slate-400">{{ $feature->description }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                @endif

                <div class="mt-16 flex items-center gap-x-6 lg:mt-24">
                    <a href="{{ route('contact') }}"
                        class="rounded-md bg-soho-teal px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-soho-teal/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-soho-teal">
                        {{ setting('btn_contact', 'İletişime Geç') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Clients Section -->
        <div class="py-24 sm:py-32 border-t border-white/5">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-center text-lg font-semibold leading-8 text-white mb-10">
                    {{ setting('references_title', 'Referanslarımız') }}</h2>
                <div
                    class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                    @forelse($clients as $client)
                        @if($client->logo)
                            <img class="col-span-2 max-h-12 w-full object-contain cursor-pointer grayscale hover:grayscale-0 transition-all duration-300 lg:col-span-1"
                                src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}">
                        @else
                            <div class="col-span-2 h-12 flex items-center justify-center text-slate-500 font-bold lg:col-span-1">
                                {{ $client->name }}</div>
                        @endif
                    @empty
                        <div class="col-span-full text-center text-slate-500 text-sm">
                            {{ setting('msg_no_clients', 'Henüz referans eklenmemiş.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="relative isolate mt-16 px-6 py-24 sm:mt-32 sm:px-16 lg:px-8">
            <div
                class="absolute inset-0 -z-10 overflow-hidden rounded-3xl bg-slate-900 border border-white/10 px-6 py-24 shadow-2xl sm:rounded-3xl sm:px-24 xl:py-32">
                <!-- Background Gradients -->
                <div class="absolute -top-1/2 -right-1/4 w-[40rem] h-[40rem] rounded-full bg-soho-purple/20 blur-[96px]">
                </div>
                <div class="absolute -bottom-1/2 -left-1/4 w-[40rem] h-[40rem] rounded-full bg-soho-teal/10 blur-[96px]">
                </div>

                <div class="mx-auto max-w-2xl text-center relative z-10">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        {{ setting('cta_title', 'Güvenliğiniz İçin Harekete Geçin') }}
                    </h2>
                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-slate-300">
                        {{ setting('cta_desc', 'Uzman ekibimizle iletişime geçin, size en uygun güvenlik çözümünü birlikte planlayalım.') }}
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('requests.fault') }}"
                            class="rounded-full bg-white px-8 py-3.5 text-sm font-bold text-slate-900 shadow-sm hover:bg-slate-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-all">
                            {{ setting('btn_quote', 'Teklif Al') }}
                        </a>
                        <a href="{{ route('contact') }}"
                            class="text-sm font-semibold leading-6 text-white hover:text-soho-teal transition-colors">
                            {{ setting('btn_contact', 'Bize Ulaşın') }} <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection