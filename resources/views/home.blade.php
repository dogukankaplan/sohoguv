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

        <!-- Hero Section -->
        <div class="relative z-10 pt-32 pb-20 sm:pt-40 sm:pb-24 lg:pb-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md mb-8 animate-fade-in-up">
                    <span class="flex h-2 w-2 rounded-full bg-soho-teal animate-pulse"></span>
                    <span class="text-sm font-medium text-slate-300">Yeni Nesil Güvenlik Sistemleri</span>
                </div>

                <h1
                    class="text-5xl font-black tracking-tight sm:text-7xl lg:text-8xl mb-8 leading-tight animate-fade-in-up animation-delay-100">
                    Güvenliği <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-soho-teal to-soho-purple">Sanata
                        Dönüştürdük.</span>
                </h1>

                <p
                    class="mt-6 text-lg sm:text-xl leading-8 text-slate-400 max-w-2xl mx-auto font-light animate-fade-in-up animation-delay-200">
                    SOHO, kurumsal altyapınızı sadece korumaz; onu akıllı, yönetilebilir ve estetik bir teknoloji merkezine
                    dönüştürür.
                </p>

                <div
                    class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-6 animate-fade-in-up animation-delay-300">
                    <a href="#services"
                        class="group relative px-8 py-4 bg-white/10 overflow-hidden rounded-full text-white shadow-2xl transition-all hover:bg-white/20 backdrop-blur-sm border border-white/10">
                        <div
                            class="absolute inset-0 w-0 bg-gradient-to-r from-soho-teal to-soho-purple transition-all duration-[250ms] ease-out group-hover:w-full opacity-20">
                        </div>
                        <span
                            class="relative text-sm font-bold uppercase tracking-wider group-hover:text-white transition-colors">Keşfetmeye
                            Başla</span>
                    </a>
                    <a href="{{ route('requests.fault') }}"
                        class="text-sm font-semibold leading-6 text-slate-300 flex items-center gap-2 hover:text-soho-teal transition-colors duration-300">
                        Arıza Bildir <span aria-hidden="true"
                            class="transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="relative z-10 border-y border-white/5 bg-white/5 backdrop-blur-sm">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12">
                <dl class="grid grid-cols-1 gap-y-8 sm:grid-cols-2 lg:grid-cols-4 text-center">
                    <div class="flex flex-col gap-y-2">
                        <dt class="text-sm leading-6 text-slate-400">Aktif Proje</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">500+</dd>
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <dt class="text-sm leading-6 text-slate-400">Kurumsal Müşteri</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">120+</dd>
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <dt class="text-sm leading-6 text-slate-400">Yıllık Tecrübe</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">15</dd>
                    </div>
                    <div class="flex flex-col gap-y-2">
                        <dt class="text-sm leading-6 text-slate-400">Destek Süresi</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white">7/24</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Services Section -->
        <div id="services" class="relative z-10 py-24 sm:py-32 bg-slate-900">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center mb-20">
                    <h2 class="text-base font-bold text-soho-teal tracking-widest uppercase">Hizmetlerimiz</h2>
                    <p class="mt-4 text-4xl font-bold tracking-tight text-white sm:text-5xl">Geleceğin Teknolojileri</p>
                    <div class="mt-4 w-24 h-1 bg-gradient-to-r from-soho-teal to-soho-purple mx-auto rounded-full"></div>
                </div>

                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @forelse($services as $service)
                        <div
                            class="group relative flex flex-col justify-between overflow-hidden rounded-3xl bg-slate-800 p-8 shadow-2xl transition-all hover:shadow-soho-purple/20 border border-slate-700 hover:border-soho-purple/50 hover:-translate-y-2 duration-300">
                            <div class="flex-grow">
                                <div
                                    class="mb-6 inline-flex items-center justify-center rounded-2xl bg-slate-900 p-3 ring-1 ring-white/10 group-hover:bg-soho-purple/20 group-hover:ring-soho-purple transition-all duration-300">
                                    @if($service->image)
                                        <img src="{{ Storage::url($service->image) }}" class="h-12 w-12 object-cover rounded-xl"
                                            alt="">
                                    @else
                                        <svg class="h-8 w-8 text-soho-teal group-hover:text-soho-purple" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                        </svg>
                                    @endif
                                </div>

                                <h3 class="text-xl font-bold text-white group-hover:text-soho-teal transition-colors mb-4">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $service->title }}
                                    </a>
                                </h3>
                                <p class="text-sm leading-6 text-slate-400 group-hover:text-slate-300 transition-colors">
                                    {{ Str::limit(strip_tags($service->content), 100) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-20">
                            <p class="text-slate-500">Henüz hizmet eklenmemiş.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Client Logos -->
        @if(isset($clients) && $clients->count() > 0)
            <div class="relative py-16 bg-slate-950 border-y border-white/5">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <p class="text-center text-sm font-semibold text-slate-500 mb-10">Güvenilen Firmalar</p>
                    <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-6">
                        @foreach($clients->take(6) as $client)
                            <div class="col-span-1 flex justify-center items-center">
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-h-12 w-full object-contain opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                                @else
                                    <span class="text-slate-600 text-sm">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Testimonials -->
        @if(isset($testimonials) && $testimonials->count() > 0)
            <div class="relative py-24 bg-slate-900">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center mb-16">
                        <h2 class="text-base font-bold text-soho-purple tracking-widest uppercase">Müşteri Yorumları</h2>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">Müşteri Memnuniyeti #1</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-slate-800/50 rounded-3xl p-8 border border-slate-700">
                                <div class="flex items-center gap-1 mb-6">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-slate-600' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                <p class="text-slate-300 leading-relaxed mb-6">"{{ $testimonial->content }}"</p>

                                <div class="flex items-center gap-4 pt-6 border-t border-slate-700">
                                    @if($testimonial->photo)
                                        <img src="{{ Storage::url($testimonial->photo) }}" alt="{{ $testimonial->name }}"
                                            class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-12 h-12 rounded-full bg-gradient-to-br from-soho-teal to-soho-purple flex items-center justify-center">
                                            <span class="text-lg font-bold text-white">{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-white">{{ $testimonial->name }}</p>
                                        @if($testimonial->role || $testimonial->company)
                                            <p class="text-sm text-slate-400">
                                                @if($testimonial->role){{ $testimonial->role }}@endif@if($testimonial->role && $testimonial->company),
                                                @endif@if($testimonial->company){{ $testimonial->company }}@endif</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Why Us Section -->
        <div class="relative py-24 sm:py-32 bg-slate-950">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-soho-purple uppercase tracking-widest">Neden Biz?</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Sizi Diğerlerinden Ayıran
                        Farklar</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                        <div class="flex flex-col">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-soho-teal" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Maksimum Güvenlik
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">En son teknolojilerle donatılmış güvenlik protokolleri sayesinde
                                    verileriniz ve mülkünüz her zaman güvende.</p>
                            </dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-soho-teal" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 001-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd" />
                                </svg>
                                Profesyonel Ekip
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">Alanında uzman sertifikalı mühendis ve teknisyenlerimizle, sorunsuz bir
                                    kurulum ve destek süreci.</p>
                            </dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-white">
                                <svg class="h-5 w-5 flex-none text-soho-teal" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M15.312 11.424a5.5 5.5 0 01-9.201 2.466l-.312-.311h2.433a1.75 1.75 0 001.75-1.75V4.75h-2.5a2.25 2.25 0 01-2.25-2.25v-2.5H8.75v11.75a2.75 2.75 0 005.498.124l.064-1.2h2l-.063 1.25a4.75 4.75 0 01-9.5 0V.25h14.5c.966 0 1.75.784 1.75 1.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 01-.75-.75v-3.076z" />
                                </svg>
                                7/24 İzleme
                            </dt>
                            <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-slate-400">
                                <p class="flex-auto">Sistemleriniz sürekli gözetim altında. Olası bir durumda anında
                                    müdahale ile iş sürekliliğinizi koruyoruz.</p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection