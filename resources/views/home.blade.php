@extends('layouts.app')

@section('content')
    <div class="relative bg-white overflow-hidden">
        <!-- Hero Section -->
        <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:static">
                <div class="sm:max-w-lg">
                    <h1 class="text-4xl font font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                        SOHO Güvenlik Sistemleri
                    </h1>
                    <p class="mt-4 text-xl text-gray-500">
                        Kurumsal güvenlik ve teknoloji altyapınız için profesyonel, uçtan uca çözümler.
                    </p>
                    <div class="mt-10">
                        <a href="#services"
                            class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700 transition">
                            Hizmetlerimizi İnceleyin
                        </a>
                    </div>
                </div>
                <div class="mt-10">
                    <!-- Decorative image grid/hero image could go here -->
                    <div aria-hidden="true"
                        class="pointer-events-none lg:absolute lg:inset-y-0 lg:max-w-7xl lg:mx-auto lg:w-full">
                        <div
                            class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                            <!-- Abstract shape or relevant professional image -->
                            <div class="flex items-center space-x-6 lg:space-x-8 opacity-20">
                                <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                    <div
                                        class="h-64 w-44 overflow-hidden rounded-lg bg-gray-100 sm:opacity-0 lg:opacity-100">
                                    </div>
                                    <div class="h-64 w-44 overflow-hidden rounded-lg bg-indigo-50"></div>
                                </div>
                                <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                    <div class="h-64 w-44 overflow-hidden rounded-lg bg-gray-100"></div>
                                    <div class="h-64 w-44 overflow-hidden rounded-lg bg-indigo-50"></div>
                                    <div class="h-64 w-44 overflow-hidden rounded-lg bg-gray-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features / Services Grid -->
        <div id="services" class="bg-gray-50 py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600">Uzmanlık Alanlarımız</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Teknoloji ve Güvenlik
                        Çözümleri</p>
                </div>
                <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @forelse($services as $service)
                        <article
                            class="flex flex-col items-start justify-between bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-300">
                            <div class="relative w-full">
                                @if($service->image)
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                                @else
                                    <div
                                        class="aspect-[16/9] w-full rounded-2xl bg-gray-100 sm:aspect-[2/1] lg:aspect-[3/2] flex items-center justify-center text-gray-300">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-line-cap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="max-w-xl">
                                <div class="mt-8 flex items-center gap-x-4 text-xs">
                                    <span class="text-gray-500">{{ $service->created_at->format('d.m.Y') }}</span>
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Hizmet</a>
                                </div>
                                <div class="group relative">
                                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                        <a href="{{ route('services.show', $service->slug) }}">
                                            <span class="absolute inset-0"></span>
                                            {{ $service->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                        {{ Str::limit(strip_tags($service->content), 120) }}
                                    </p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-3 text-center text-gray-500 py-12">
                            Henüz hizmet eklenmemiş.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection