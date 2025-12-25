<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-slate-900/80 backdrop-blur-xl border-b border-white/10': scrolled, 'bg-transparent border-transparent': !scrolled }"
    class="fixed top-0 w-full z-50 transition-all duration-300 border-b">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 justify-between items-center transition-all duration-300" :class="{ 'h-16': scrolled }">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-black tracking-tighter text-white flex items-center gap-1 group">
                        SOHO<span
                            class="text-soho-teal group-hover:text-soho-purple transition-colors duration-300 text-3xl">.</span>
                    </a>
                </div>
                <div class="hidden sm:ml-12 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-300 hover:text-white hover:border-soho-teal transition-all duration-200">
                        {{ setting('page_home', 'Ana Sayfa') }}
                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="inline-flex items-center text-sm font-medium text-slate-300 hover:text-white focus:outline-none transition-colors duration-200 group">
                            <span>{{ setting('page_services', 'Hizmetler') }}</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-slate-500 group-hover:text-soho-teal transition-colors"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="absolute left-0 top-full z-10 mt-2 w-64 origin-top-left rounded-2xl bg-slate-800 p-2 shadow-2xl ring-1 ring-white/10 focus:outline-none backdrop-blur-xl"
                            style="display: none;">
                            @if(isset($globalServices) && $globalServices->count() > 0)
                                @foreach($globalServices as $service)
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="block rounded-xl px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-soho-teal transition-colors duration-150">
                                        {{ $service->title }}
                                    </a>
                                @endforeach
                            @else
                                <span class="block px-4 py-3 text-sm text-slate-500 italic">Servis bulunamadı</span>
                            @endif
                        </div>
                    </div>

                    <!-- Requests Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="inline-flex items-center text-sm font-medium text-slate-300 hover:text-white focus:outline-none transition-colors duration-200 group">
                            <span>Talepler</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-slate-500 group-hover:text-soho-teal transition-colors"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="absolute left-0 top-full z-10 mt-2 w-56 origin-top-left rounded-2xl bg-slate-800 p-2 shadow-2xl ring-1 ring-white/10 focus:outline-none backdrop-blur-xl"
                            style="display: none;">
                            <a href="{{ route('requests.fault') }}"
                                class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-red-400 transition-colors duration-150">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Arıza Talebi
                            </a>
                            <a href="{{ route('requests.inventory') }}"
                                class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-amber-400 transition-colors duration-150">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Envanter Talebi
                            </a>
                        </div>
                    </div>

                    <!-- Static Links -->
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-300 hover:text-white hover:border-soho-purple transition-all duration-200">
                        {{ setting('page_about', 'Hakkımızda') }}
                    </a>
                    <a href="{{ route('references') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-300 hover:text-white hover:border-soho-purple transition-all duration-200">
                        {{ setting('page_references', 'Referanslar') }}
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-300 hover:text-white hover:border-soho-purple transition-all duration-200">
                        {{ setting('page_contact', 'İletişim') }}
                    </a>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="hidden sm:flex items-center">
                <a href="{{ route('requests.fault') }}"
                    class="ml-6 inline-flex items-center rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                    {{ setting('btn_quote', 'Destek Al') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-slate-400 hover:bg-slate-800 hover:text-white focus:outline-none transition-colors">
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
        class="sm:hidden bg-slate-900/95 backdrop-blur-xl border-b border-white/10 absolute w-full shadow-2xl">
        <div class="space-y-1 pb-4 pt-2 px-4">
            <a href="{{ route('home') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-soho-teal">Ana
                Sayfa</a>

            <div class="px-3 py-2 text-xs font-bold text-slate-500 uppercase tracking-widest mt-4">Hizmetlerimiz</div>
            @if(isset($globalServices))
                @foreach($globalServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-soho-teal pl-6 border-l-2 border-transparent hover:border-soho-teal">{{ $service->title }}</a>
                @endforeach
            @endif

            <div class="px-3 py-2 text-xs font-bold text-slate-500 uppercase tracking-widest mt-4">Talep Yönetimi</div>
            <a href="{{ route('requests.fault') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-red-400">Arıza
                Talebi</a>
            <a href="{{ route('requests.inventory') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-amber-400">Envanter
                Talebi</a>

            <div class="px-3 py-2 text-xs font-bold text-slate-500 uppercase tracking-widest mt-4">Kurumsal</div>
            <a href="{{ route('about') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-soho-purple">Hakkımızda</a>
            <a href="{{ route('references') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-soho-purple">Referanslar</a>
            <a href="{{ route('contact') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-300 hover:bg-white/5 hover:text-soho-purple">İletişim</a>
        </div>
    </div>
</nav>