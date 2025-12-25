<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-gray-900">
                        SOHO<span class="text-indigo-600">.</span>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                        Ana Sayfa
                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @click.away="open = false">
                        <button @click="open = ! open"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 focus:outline-none">
                            <span>Servisler</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 top-full z-10 mt-1 w-56 origin-top-left rounded-xl bg-white p-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            @if(isset($globalServices) && $globalServices->count() > 0)
                                @foreach($globalServices as $service)
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="block rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        {{ $service->title }}
                                    </a>
                                @endforeach
                            @else
                                <span class="block px-4 py-2 text-sm text-gray-500">Servis bulunamadı</span>
                            @endif
                        </div>
                    </div>

                    <!-- Requests Dropdown -->
                    <div class="relative inline-flex items-center px-1 pt-1" x-data="{ open: false }"
                        @click.away="open = false">
                        <button @click="open = ! open"
                            class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 focus:outline-none">
                            <span>Talepler</span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 top-full z-10 mt-1 w-56 origin-top-left rounded-xl bg-white p-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="{{ route('requests.fault') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Arıza Talebi
                            </a>
                            <a href="{{ route('requests.inventory') }}"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Envanter Talebi
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="space-y-1 pb-3 pt-2">
            <a href="{{ route('home') }}"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Ana
                Sayfa</a>

            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Servisler</div>
            @if(isset($globalServices))
                @foreach($globalServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                        class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700 sm:pl-5">{{ $service->title }}</a>
                @endforeach
            @endif

            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-2">Talepler</div>
            <a href="{{ route('requests.fault') }}"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Arıza
                Talebi</a>
            <a href="{{ route('requests.inventory') }}"
                class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700">Envanter
                Talebi</a>
        </div>
    </div>
</nav>