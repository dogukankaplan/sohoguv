@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden bg-white">
        <!-- Abstract Background Shapes -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-[600px] h-[600px] rounded-full bg-indigo-50/50 blur-3xl opacity-60 mix-blend-multiply animate-blob">
            </div>
            <div
                class="absolute top-40 -left-40 w-[600px] h-[600px] rounded-full bg-blue-50/50 blur-3xl opacity-60 mix-blend-multiply animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-40 left-1/2 w-[600px] h-[600px] rounded-full bg-purple-50/50 blur-3xl opacity-60 mix-blend-multiply animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Hero Section -->
        <div class="relative z-10 pt-20 pb-32 sm:pt-32 sm:pb-40 lg:pb-48">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 sm:text-7xl mb-8 drop-shadow-sm">
                    Geleceğin Güvenlik <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Çözümleri
                        Burada.</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl mx-auto font-medium">
                    Kurumsal altyapınız için uçtan uca, yönetilebilir ve akıllı güvenlik sistemleri.
                    SOHO ile teknolojiyi güvenliğe dönüştürün.
                </p>
                <div class="mt-12 flex items-center justify-center gap-x-6">
                    <a href="#services"
                        class="rounded-full bg-slate-900 px-8 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:bg-slate-800 hover:scale-105 transition-all duration-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Keşfetmeye Başla
                    </a>
                    <a href="{{ route('requests.fault') }}"
                        class="text-sm font-semibold leading-6 text-slate-900 flex items-center gap-2 hover:text-indigo-600 transition-colors">
                        Arıza Bildir <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div id="services" class="relative z-10 py-24 sm:py-32 bg-slate-50/50 backdrop-blur-sm">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center mb-16">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600 uppercase tracking-wide">Hizmetlerimiz</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Teknolojiyi Sizin İçin
                        Yönetiyoruz</p>
                </div>

                <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @forelse($services as $service)
                        <article
                            class="flex flex-col items-start justify-between bg-white rounded-3xl p-2 shadow-sm ring-1 ring-slate-200/50 hover:shadow-2xl hover:shadow-indigo-500/10 hover:-translate-y-1 transition-all duration-300 group h-full">
                            <div class="relative w-full overflow-hidden rounded-2xl aspect-[16/9]">
                                @if($service->image)
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-300 group-hover:scale-110 transition-transform duration-500">
                                        <svg class="h-12 w-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-line-cap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                            <div class="max-w-xl p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-x-4 text-xs mb-4">
                                    <span
                                        class="text-slate-500 bg-slate-100 px-3 py-1 rounded-full font-medium">{{ $service->created_at->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3
                                    class="text-xl font-bold leading-6 text-slate-900 group-hover:text-indigo-600 transition-colors duration-200 mb-3">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        <span class="absolute inset-0"></span>
                                        {{ $service->title }}
                                    </a>
                                </h3>
                                <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600 flex-grow">
                                    {{ Str::limit(strip_tags($service->content), 120) }}
                                </p>
                                <div
                                    class="mt-6 flex items-center text-indigo-600 font-semibold text-sm group-hover:translate-x-1 transition-transform duration-200">
                                    Detayları İncele <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div
                            class="col-span-3 flex flex-col items-center justify-center text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <svg class="h-12 w-12 text-slate-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-slate-900">Henüz hizmet bulunmuyor</h3>
                            <p class="mt-1 text-sm text-slate-500">Admin panelinden yeni hizmetler ekleyebilirsiniz.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
@endsection