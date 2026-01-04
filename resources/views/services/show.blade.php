@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen">
        {{-- Hero --}}
        <section class="relative py-20 bg-gradient-subtle overflow-hidden">
            {{-- Background Elements --}}
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-cyan-100 rounded-full opacity-20 blur-3xl translate-x-1/2 -translate-y-1/2">
            </div>

            <div class="container-custom relative z-10">
                <div class="max-w-4xl mx-auto text-center space-y-6 animate-fade-in">
                    <a href="{{ route('home') }}#services"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-cyan-600 hover:text-cyan-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Hizmetlere Dön
                    </a>

                    <h1 class="heading-hero">
                        {!! str_replace(' ', ' <span class="text-gradient">', $service->title) . '</span>' !!}
                    </h1>
                </div>
            </div>
        </section>

        {{-- Content --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="grid lg:grid-cols-3 gap-12">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2 space-y-8 animate-slide-up">
                        @if($service->image)
                            <div class="rounded-4xl overflow-hidden shadow-soft aspect-video relative group">
                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                            </div>
                        @endif

                        <div class="prose prose-lg prose-gray max-w-none">
                            {!! $service->content !!}
                        </div>

                        {{-- CTA Box --}}
                        <div class="card-gradient-border mt-12">
                            <div class="flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                                <div class="icon-circle-gradient flex-shrink-0">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-grow">
                                    <h3 class="heading-md mb-2">Bu Hizmet İçin Teklif Alın</h3>
                                    <p class="text-gray-600">Projenize özel çözümler ve fiyatlandırma için bizimle iletişime
                                        geçin.</p>
                                </div>
                                <a href="{{ route('contact') }}" class="btn-gradient-primary flex-shrink-0">
                                    Teklif İste
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-8 animate-slide-up animate-delay-200">
                        {{-- Quick Contact --}}
                        <div class="card-modern bg-gray-50">
                            <h3 class="heading-sm mb-6">İletişim</h3>
                            <div class="space-y-4">
                                <a href="tel:{{ setting('phone') }}"
                                    class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-gray-200 hover:border-cyan-500 transition group">
                                    <div
                                        class="w-10 h-10 rounded-full bg-cyan-50 flex items-center justify-center group-hover:bg-cyan-500 transition">
                                        <svg class="w-5 h-5 text-cyan-600 group-hover:text-white transition" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Hemen Ara</span>
                                </a>
                                <a href="{{ route('contact') }}"
                                    class="flex items-center gap-3 p-4 rounded-2xl bg-white border border-gray-200 hover:border-magenta-500 transition group">
                                    <div
                                        class="w-10 h-10 rounded-full bg-magenta-50 flex items-center justify-center group-hover:bg-magenta-500 transition">
                                        <svg class="w-5 h-5 text-magenta-600 group-hover:text-white transition" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-900">Mesaj Gönder</span>
                                </a>
                            </div>
                        </div>

                        {{-- Other Services --}}
                        @php
                            $otherServices = \App\Models\Service::where('id', '!=', $service->id)->take(5)->get();
                        @endphp
                        @if($otherServices->count() > 0)
                            <div class="card-modern">
                                <h3 class="heading-sm mb-6">Diğer Hizmetler</h3>
                                <div class="space-y-4">
                                    @foreach($otherServices as $other)
                                        <a href="{{ route('services.show', $other->slug) }}" class="block group">
                                            <div
                                                class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition">
                                                <span
                                                    class="text-gray-700 font-medium group-hover:text-cyan-600 transition">{{ $other->title }}</span>
                                                <svg class="w-4 h-4 text-gray-400 group-hover:text-cyan-500 group-hover:translate-x-1 transition"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection