@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg pb-16 lg:pb-24">
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Service",
          "name": "{{ $service->title }}",
          "provider": {
            "@type": "LocalBusiness",
            "name": "{{ setting('site_name', 'SOHO Güvenlik Sistemleri') }}"
          },
          "areaServed": {
            "@type": "City",
            "name": "İzmir"
          },
          "description": "{{ isset($description) ? $description : Str::limit(strip_tags($service->description), 160) }}"
        }
        </script>
        {{-- Hero / Header --}}
        <div class="relative h-[50vh] min-h-[400px] w-full overflow-hidden bg-white">
            @if($service->image)
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ Storage::url($service->image) }}"
                    alt="{{ $service->title }}">
                <div class="absolute inset-0 bg-gradient-to-t from-white via-white/60 to-primary-500/80"></div>
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                    <svg class="h-32 w-32 text-white opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-white via-white/20 to-transparent"></div>
            @endif

            <div class="absolute bottom-0 left-0 w-full pb-16 pt-12">
                <div class="container-custom">
                    <nav class="flex mb-4 text-sm font-medium text-neutral-medium">
                        <a href="{{ route('home') }}" class="hover:text-secondary-500 transition-colors">{{ setting('page_home', 'Ana Sayfa') }}</a>
                        <span class="mx-2">/</span>
                        <span class="text-primary-500 font-semibold">{{ $service->title }}</span>
                    </nav>
                    <h1 class="text-4xl font-bold tracking-tight text-primary-500 sm:text-5xl md:text-6xl">
                        {{ $service->title }}
                    </h1>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="container-custom -mt-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- Article --}}
                <div class="lg:col-span-2 card p-8 sm:p-12">
                    <div class="prose prose-lg max-w-none text-neutral-medium">
                        {!! $service->content !!}
                    </div>
                </div>

                {{-- Sidebar / CTA --}}
                <div class="space-y-6">
                    <div class="card p-8 sticky top-24">
                        <h3 class="text-xl font-bold text-primary-500 mb-6">{{ setting('sidebar_actions_title', 'Hızlı İşlemler') }}</h3>

                        <div class="space-y-4">
                            <div class="border border-neutral-light rounded-lg p-6 hover:border-secondary-500 transition-colors">
                                <div class="flex items-center gap-3 mb-3 text-secondary-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <h4 class="font-semibold text-primary-500">{{ setting('sidebar_support_title', 'Teknik Destek') }}</h4>
                                </div>
                                <p class="text-sm text-neutral-medium mb-4">{{ setting('sidebar_support_desc', 'Bir sorun mu yaşıyorsunuz? Teknik ekibimize bildirin.') }}
                                </p>
                                <a href="{{ route('requests.fault') }}" class="btn-primary w-full text-center text-sm">
                                    {{ setting('btn_create_fault', 'Arıza Kaydı Oluştur') }}
                                </a>
                            </div>

                            <div class="border border-neutral-light rounded-lg p-6 hover:border-accent-500 transition-colors">
                                <div class="flex items-center gap-3 mb-3 text-accent-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <h4 class="font-semibold text-primary-500">{{ setting('sidebar_inventory_title', 'Envanter Talebi') }}</h4>
                                </div>
                                <p class="text-sm text-neutral-medium mb-4">{{ setting('sidebar_inventory_desc', 'Yeni donanım veya yazılım ihtiyacınız mı var?') }}</p>
                                <a href="{{ route('requests.inventory') }}" class="btn-accent w-full text-center text-sm">
                                    {{ setting('btn_create_request', 'Talep Oluştur') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection