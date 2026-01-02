@php
    $globalServices = \App\Models\Service::latest()->take(6)->get();
    $siteIdentity = \App\Models\SiteIdentity::first();
@endphp

<nav x-data="{ mobileMenuOpen: false }"
    class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200">
    <div class="container-custom">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if(isset($siteIdentity->logo) && $siteIdentity->logo)
                        <img src="{{ Storage::url($siteIdentity->logo) }}" alt="{{ $siteIdentity->site_name ?? 'SOHO' }}"
                            class="h-10 w-auto">
                    @else
                        <span class="text-2xl font-bold text-gray-900">SOHO</span>
                        <span class="text-gradient text-2xl font-bold">Güvenlik</span>
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium text-gray-700 hover:text-cyan-500 transition">Ana Sayfa</a>
                <a href="{{ route('about') }}"
                    class="text-sm font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_about', 'Hakkımızda') }}</a>

                <!-- Services Dropdown -->
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button
                        class="text-sm font-medium text-gray-700 hover:text-cyan-500 transition inline-flex items-center gap-1">
                        {{ setting('page_services', 'Hizmetler') }}
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-4"
                        class="absolute left-0 mt-6 w-64 bg-white rounded-2xl shadow-strong border border-gray-100 py-4"
                        style="display: none;">
                        @foreach($globalServices as $service)
                            <a href="{{ route('services.show', $service->slug) }}"
                                class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50hover:text-cyan-500 transition">
                                {{ $service->title }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('references') }}"
                    class="text-sm font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_references', 'Referanslar') }}</a>
                <a href="{{ route('contact') }}"
                    class="text-sm font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_contact', 'İletişim') }}</a>
            </div>

            <!-- CTA Button (Desktop) -->
            <div class="hidden lg:block">
                <a href="{{ route('quote') }}" class="btn-gradient-primary">
                    Teklif Al
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4" class="lg:hidden bg-white border-t border-gray-200"
        style="display: none;">
        <div class="container-custom py-6 space-y-4">
            <a href="{{ route('home') }}"
                class="block text-base font-medium text-gray-700 hover:text-cyan-500 transition">Ana Sayfa</a>
            <a href="{{ route('about') }}"
                class="block text-base font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_about', 'Hakkımızda') }}</a>

            <!-- Mobile Services -->
            <div>
                <p class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">
                    {{ setting('page_services', 'Hizmetler') }}</p>
                <div class="pl-4 space-y-2">
                    @foreach($globalServices as $service)
                        <a href="{{ route('services.show', $service->slug) }}"
                            class="block text-sm text-gray-600 hover:text-cyan-500 transition">
                            {{ $service->title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('references') }}"
                class="block text-base font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_references', 'Referanslar') }}</a>
            <a href="{{ route('contact') }}"
                class="block text-base font-medium text-gray-700 hover:text-cyan-500 transition">{{ setting('page_contact', 'İletişim') }}</a>

            <a href="{{ route('quote') }}" class="btn-gradient-primary w-full justify-center mt-4">
                Teklif Al
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</nav>

<!-- Spacer for Fixed Navigation -->
<div class="h-20"></div>