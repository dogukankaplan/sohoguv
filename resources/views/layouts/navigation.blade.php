<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-white shadow-soft': scrolled, 'bg-white/95 backdrop-blur-sm': !scrolled }"
    class="fixed top-0 w-full z-50 transition-all duration-300">
    <div class="container-custom">
        <div class="flex h-20 justify-between items-center">
            <!-- Logo -->
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-black tracking-tight text-primary-500 flex items-center gap-2 group">
                        <span>SOHO</span>
                        <span
                            class="text-secondary-500 group-hover:text-accent-500 transition-colors duration-300">Güvenlik</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:ml-12 lg:flex lg:space-x-8">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-neutral-dark hover:text-secondary-500 hover:border-secondary-500 transition-all duration-200">
                        {{ setting('page_home', 'Ana Sayfa') }}
                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="inline-flex items-center text-sm font-medium text-neutral-dark hover:text-secondary-500 focus:outline-none transition-colors duration-200 group">
                            <span>{{ setting('page_services', 'Hizmetler') }}</span>
                            <svg class="ml-1 h-4 w-4 text-neutral-medium group-hover:text-secondary-500 transition-colors"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-0 top-full z-10 mt-3 w-64 origin-top-left rounded-lg bg-white shadow-medium border border-neutral-light focus:outline-none"
                            style="display: none;">
                            @if(isset($globalServices) && $globalServices->count() > 0)
                                <div class="py-2">
                                    @foreach($globalServices as $service)
                                        <a href="{{ route('services.show', $service->slug) }}"
                                            class="block px-4 py-2 text-sm text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500 transition-colors duration-150">
                                            {{ $service->title }}
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <span class="block px-4 py-3 text-sm text-neutral-medium italic">Servis bulunamadı</span>
                            @endif
                        </div>
                    </div>

                    <!-- Requests Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="inline-flex items-center text-sm font-medium text-neutral-dark hover:text-secondary-500 focus:outline-none transition-colors duration-200 group">
                            <span>Talepler</span>
                            <svg class="ml-1 h-4 w-4 text-neutral-medium group-hover:text-secondary-500 transition-colors"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-0 top-full z-10 mt-3 w-56 origin-top-left rounded-lg bg-white shadow-medium border border-neutral-light focus:outline-none"
                            style="display: none;">
                            <div class="py-2">
                                <a href="{{ route('requests.fault') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-neutral-dark hover:bg-red-50 hover:text-red-600 transition-colors duration-150">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Arıza Talebi
                                </a>
                                <a href="{{ route('requests.inventory') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-neutral-dark hover:bg-amber-50 hover:text-amber-600 transition-colors duration-150">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Envanter Talebi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Static Links -->
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-neutral-dark hover:text-secondary-500 hover:border-secondary-500 transition-all duration-200">
                        {{ setting('page_about', 'Hakkımızda') }}
                    </a>
                    <a href="{{ route('references') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-neutral-dark hover:text-secondary-500 hover:border-secondary-500 transition-all duration-200">
                        {{ setting('page_references', 'Referanslar') }}
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-neutral-dark hover:text-secondary-500 hover:border-secondary-500 transition-all duration-200">
                        {{ setting('page_contact', 'İletişim') }}
                    </a>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="hidden lg:flex items-center">
                <a href="{{ route('requests.fault') }}" class="btn-accent">
                    {{ setting('btn_quote', 'Destek Al') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-neutral-dark hover:bg-neutral-light transition-colors">
                    <span class="sr-only">Menüyü aç/kapa</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-white border-t border-neutral-light shadow-medium">
        <div class="space-y-1 pb-4 pt-2 px-4">
            <a href="{{ route('home') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500">
                Ana Sayfa
            </a>

            <div class="px-3 py-2 text-xs font-bold text-neutral-medium uppercase tracking-wider">Hizmetlerimiz</div>
            @if(isset($globalServices))
                @foreach($globalServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500 pl-6 border-l-2 border-transparent hover:border-secondary-500">
                        {{ $service->title }}
                    </a>
                @endforeach
            @endif

            <div class="px-3 py-2 text-xs font-bold text-neutral-medium uppercase tracking-wider mt-4">Talep Yönetimi
            </div>
            <a href="{{ route('requests.fault') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-red-50 hover:text-red-600">
                Arıza Talebi
            </a>
            <a href="{{ route('requests.inventory') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-amber-50 hover:text-amber-600">
                Envanter Talebi
            </a>

            <div class="px-3 py-2 text-xs font-bold text-neutral-medium uppercase tracking-wider mt-4">Kurumsal</div>
            <a href="{{ route('about') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500">
                Hakkımızda
            </a>
            <a href="{{ route('references') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500">
                Referanslar
            </a>
            <a href="{{ route('contact') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-neutral-dark hover:bg-secondary-50 hover:text-secondary-500">
                İletişim
            </a>
        </div>
    </div>
</nav>