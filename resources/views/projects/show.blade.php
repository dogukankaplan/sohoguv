@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-32 pb-20">
        <div class="container-custom">

            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-brand-600 transition">Anasayfa</a>
                <span class="mx-2">/</span>
                <a href="{{ route('projects.index') }}" class="hover:text-brand-600 transition">Projeler</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900 font-medium truncate max-w-[200px]">{{ $project->title }}</span>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-12">
                    {{-- Main Image --}}
                    <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-100 aspect-video relative group">
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                    </div>

                    {{-- Content --}}
                    <div
                        class="prose prose-lg prose-slate max-w-none bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-100">
                        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">{{ $project->title }}</h1>
                        {!! $project->content !!}
                    </div>

                    {{-- Gallery --}}
                    @if(!empty($project->gallery) && count($project->gallery) > 0)
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-brand-100 flex items-center justify-center text-brand-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                Proje Galerisi
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4"
                                x-data="{ lightboxOpen: false, activeImage: '' }">
                                @foreach($project->gallery as $image)
                                    <div class="aspect-square rounded-2xl overflow-hidden cursor-pointer group relative"
                                        @click="lightboxOpen = true; activeImage = '{{ Storage::url($image) }}'">
                                        <img src="{{ Storage::url($image) }}" alt="Gallery Image"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
                                    </div>
                                @endforeach

                                {{-- Simple Lightbox (Alpine) --}}
                                <div x-show="lightboxOpen" x-transition.opacity
                                    class="fixed inset-0 z-[100] bg-black/90 flex items-center justify-center p-4"
                                    @keydown.escape.window="lightboxOpen = false">
                                    <button @click="lightboxOpen = false"
                                        class="absolute top-6 right-6 text-white hover:text-brand-400 transition">
                                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <img :src="activeImage" class="max-w-full max-h-[90vh] rounded-xl shadow-2xl">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">

                    {{-- Project Info Card --}}
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100 sticky top-32">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Proje Detayları</h3>

                        <div class="space-y-6">
                            @if($project->client)
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Müşteri</p>
                                        <p class="text-slate-900 font-medium">{{ $project->client }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($project->location)
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Lokasyon</p>
                                        <p class="text-slate-900 font-medium">{{ $project->location }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($project->completion_date)
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Tarih</p>
                                        <p class="text-slate-900 font-medium">{{ $project->completion_date->format('d.m.Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Durum</p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $project->status === 'completed' ? 'Tamamlandı' : 'Devam Ediyor' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 mt-8 pt-8">
                            <a href="{{ route('contact') }}"
                                class="w-full block text-center bg-brand-600 text-white font-bold py-4 rounded-xl hover:bg-brand-700 transition shadow-lg hover:shadow-xl">
                                Benzer Proje Teklifi Al
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection