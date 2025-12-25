@extends('layouts.app')

@section('content')
    <div class="relative bg-white pb-16 lg:pb-24">
        <!-- Hero / Header -->
        <div class="relative h-[50vh] min-h-[400px] w-full overflow-hidden">
            @if($service->image)
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ Storage::url($service->image) }}"
                    alt="{{ $service->title }}">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 to-indigo-900 flex items-center justify-center">
                    <svg class="h-32 w-32 text-white/10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-white via-white/20 to-black/60"></div>

            <div class="absolute bottom-0 left-0 w-full pb-16 pt-12">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <nav class="flex mb-4 text-sm font-medium text-slate-300 animate-fade-in-up">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ setting('page_home', 'Ana Sayfa') }}</a>
                        <span class="mx-2">/</span>
                        <span class="text-white">{{ $service->title }}</span>
                    </nav>
                    <h1
                        class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl md:text-6xl drop-shadow-sm animate-fade-in-up animation-delay-100">
                        {{ $service->title }}
                    </h1>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="mx-auto max-w-7xl px-6 lg:px-8 -mt-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Article -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-8 sm:p-12 shadow-xl ring-1 ring-slate-900/5">
                    <div class="prose prose-lg prose-indigo max-w-none text-slate-600">
                        {!! $service->content !!}
                    </div>
                </div>

                <!-- Sidebar / CTA -->
                <div class="space-y-8">
                    <div class="rounded-3xl bg-slate-50 p-8 border border-slate-100 shadow-sm sticky top-24">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">{{ setting('sidebar_actions_title', 'Hızlı İşlemler') }}</h3>

                        <div class="space-y-4">
                            <div
                                class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <h4 class="font-semibold text-slate-900">{{ setting('sidebar_support_title', 'Teknik Destek') }}</h4>
                                </div>
                                <p class="text-sm text-slate-500 mb-4">{{ setting('sidebar_support_desc', 'Bir sorun mu yaşıyorsunuz? Teknik ekibimize bildirin.') }}
                                </p>
                                <a href="{{ route('requests.fault') }}"
                                    class="block w-full text-center rounded-xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-100 transition-colors">{{ setting('btn_create_fault', 'Arıza Kaydı Oluştur') }}</a>
                            </div>

                            <div
                                class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3 mb-2 text-amber-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <h4 class="font-semibold text-slate-900">{{ setting('sidebar_inventory_title', 'Envanter Talebi') }}</h4>
                                </div>
                                <p class="text-sm text-slate-500 mb-4">{{ setting('sidebar_inventory_desc', 'Yeni donanım veya yazılım ihtiyacınız mı var?') }}</p>
                                <a href="{{ route('requests.inventory') }}"
                                    class="block w-full text-center rounded-xl bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-600 hover:bg-amber-100 transition-colors">{{ setting('btn_create_request', 'Talep Oluştur') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .animation-delay-100 {
            animation-delay: 0.1s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection