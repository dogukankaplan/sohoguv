@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50">

        {{-- Hero Section --}}
        <section class="relative pt-32 pb-20 overflow-hidden bg-slate-900">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900"></div>

            <div class="container-custom relative z-10 text-center text-white">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">Projelerimiz</h1>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                    Türkiye genelinde başarıyla tamamladığımız ve devam eden güvenlik projelerimizden örnekler.
                </p>
            </div>
        </section>

        {{-- Projects Section with Tabs --}}
        <section class="py-20" x-data="{ activeTab: 'completed' }">
            <div class="container-custom">

                {{-- Tabs Navigation --}}
                <div class="flex justify-center mb-12">
                    <div class="inline-flex bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200">
                        <button @click="activeTab = 'completed'"
                            :class="{ 'bg-brand-600 text-white shadow-md': activeTab === 'completed', 'text-slate-600 hover:text-brand-600': activeTab !== 'completed' }"
                            class="px-8 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tamamlanan Projeler
                        </button>
                        <button @click="activeTab = 'ongoing'"
                            :class="{ 'bg-yellow-500 text-white shadow-md': activeTab === 'ongoing', 'text-slate-600 hover:text-yellow-600': activeTab !== 'ongoing' }"
                            class="px-8 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Devam Eden Projeler
                        </button>
                    </div>
                </div>

                {{-- Completed Projects Grid --}}
                <div x-show="activeTab === 'completed'" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse($completedProjects as $project)
                        <a href="{{ route('projects.show', $project->slug) }}"
                            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-slate-100">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                                <div
                                    class="absolute bottom-4 left-4 right-4 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-brand-500 text-white text-xs font-medium">
                                        İncele
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-brand-600 transition-colors mb-2">
                                    {{ $project->title }}</h3>
                                <div class="flex items-center gap-4 text-sm text-slate-500">
                                    @if($project->location)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $project->location }}
                                        </span>
                                    @endif
                                    @if($project->client)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $project->client }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="inline-flex p-4 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-slate-900">Henüz tamamlanan proje eklenmedi.</h3>
                        </div>
                    @endforelse
                </div>

                {{-- Ongoing Projects Grid --}}
                <div x-show="activeTab === 'ongoing'" x-cloak x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse($ongoingProjects as $project)
                        <a href="{{ route('projects.show', $project->slug) }}"
                            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-slate-100 relative">
                            {{-- Ongoing Badge --}}
                            <div class="absolute top-4 right-4 z-10">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-yellow-500 text-white text-xs font-bold shadow-lg">
                                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                                    Devam Ediyor
                                </span>
                            </div>

                            <div
                                class="relative h-64 overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-500">
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-yellow-600 transition-colors mb-2">
                                    {{ $project->title }}</h3>
                                <p class="text-slate-600 line-clamp-2 text-sm">{{ $project->description }}</p>

                                {{-- Progress Bar Simulation --}}
                                <div class="mt-4">
                                    <div class="flex justify-between items-center text-xs font-medium text-slate-500 mb-1">
                                        <span>Tamamlanma</span>
                                        <span>%75</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-500 w-3/4 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="inline-flex p-4 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-slate-900">Şu an devam eden projemiz bulunmuyor.</h3>
                        </div>
                    @endforelse
                </div>

            </div>
        </section>
    </div>
@endsection