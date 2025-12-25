<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-white/80 backdrop-blur-md shadow-sm': scrolled, 'bg-transparent': !scrolled }"
    class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-transparent"
    :style="scrolled ? 'border-color: rgba(226, 232, 240, 0.8)' : ''">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 justify-between items-center transition-all duration-300" :class="{ 'h-16': scrolled }">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-bold tracking-tighter text-slate-900 flex items-center gap-1 group">
                        SOHO<span
                            class="text-indigo-600 group-hover:rotate-12 transition-transform duration-300 text-3xl">.</span>
                    </a>
                </div>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-slate-500 hover:text-slate-900 hover:border-indigo-500 transition-all duration-200">
                        Ana Sayfa
                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-900 focus:outline-none transition-colors duration-200 group">
                            <span>Servisler</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-slate-400 group-hover:text-slate-600 transition-colors"
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
                            class="absolute left-0 top-full z-10 mt-1 w-64 origin-top-left rounded-2xl bg-white p-2 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none backdrop-blur-xl"
                            style="display: none;">
                            @if(isset($globalServices) && $globalServices->count() > 0)
                                @foreach($globalServices as $service)
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="block rounded-xl px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-indigo-600 transition-colors duration-150">
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
                            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-900 focus:outline-none transition-colors duration-200 group">
                            <span>Talepler</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4 text-slate-400 group-hover:text-slate-600 transition-colors"
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
                            class="absolute left-0 top-full z-10 mt-1 w-56 origin-top-left rounded-2xl bg-white p-2 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="{{ route('requests.fault') }}"
                                class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-slate-600 hover:bg-red-50 hover:text-red-600 transition-colors duration-150">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Arıza Talebi
                            </a>
                            <a href="{{ route('requests.inventory') }}"
                                class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-slate-600 hover:bg-amber-50 hover:text-amber-600 transition-colors duration-150">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Envanter Talebi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-colors">
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
        class="sm:hidden bg-white/95 backdrop-blur-md border-b border-slate-200 absolute w-full shadow-lg">
        <div class="space-y-1 pb-4 pt-2 px-4">
            <a href="{{ route('home') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600">Ana
                Sayfa</a>

            <div class="px-3 py-2 text-xs font-bold text-slate-400 uppercase tracking-widest mt-4">Hizmetlerimiz</div>
            @if(isset($globalServices))
                @foreach($globalServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                        class="block rounded-lg px-3 py-2 text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-indigo-600 pl-6 border-l-2 border-transparent hover:border-indigo-500">{{ $service->title }}</a>
                @endforeach
            @endif

            <div class="px-3 py-2 text-xs font-bold text-slate-400 uppercase tracking-widest mt-4">Talep Yönetimi</div>
            <a href="{{ route('requests.fault') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-600 hover:bg-red-50 hover:text-red-700">Arıza
                Talebi</a>
            <a href="{{ route('requests.inventory') }}"
                class="block rounded-lg px-3 py-2 text-base font-medium text-slate-600 hover:bg-amber-50 hover:text-amber-700">Envanter
                Talebi</a>
        </div>
    </div>
</nav>