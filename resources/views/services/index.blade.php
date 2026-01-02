@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-cyan-100 rounded-full opacity-30 blur-3xl translate-x-1/3 -translate-y-1/3">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-purple-100 rounded-full opacity-30 blur-3xl -translate-x-1/3 translate-y-1/3">
            </div>
        </div>

        <div class="container-custom relative z-10 text-center animate-fade-in">
            <h1 class="heading-hero mb-6">
                <span class="text-gradient">Hizmetlerimiz</span>
            </h1>
            <p class="text-body-lg max-w-2xl mx-auto">
                {{ setting('services_page_desc', 'Ev ve iş yerleriniz için en son teknoloji güvenlik ve otomasyon çözümleri sunuyoruz.') }}
            </p>
        </div>
    </section>

    {{-- Services Grid --}}
    <section class="section-padding-sm bg-gray-50 min-h-[50vh]">
        <div class="container-custom">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="card-gradient-border group animate-slide-up"
                        style="animation-delay: {{ $loop->index * 100 }}ms">
                        <div class="p-8">
                            <div
                                class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center mb-6 group-hover:bg-cyan-50 transition-colors duration-300 shadow-sm">
                                <img src="{{ $service->image ? Storage::url($service->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRz-k3qGvM3g1S-XgE1CgE22gX1jG1k9l5g9g&s' }}"
                                    class="w-8 h-8 opacity-60 group-hover:opacity-100 transition-opacity" alt="Icon">
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-cyan-600 transition-colors">
                                {{ $service->title }}</h3>
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($service->content), 120) }}
                            </p>
                            <a href="{{ route('services.show', $service->slug) }}"
                                class="inline-flex items-center text-sm font-bold text-gray-900 hover:text-cyan-600 transition-colors">
                                Detayları İncele
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($services->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-500">Henüz hizmet eklenmemiş.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-purple-600"></div>
        <div class="container-custom relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Özel Bir Çözüm mü Arıyorsunuz?</h2>
            <div class="flex justify-center gap-4">
                <a href="{{ route('contact') }}"
                    class="px-8 py-3 rounded-full bg-white text-gray-900 font-bold hover:bg-gray-50 transition shadow-lg">Bize
                    Ulaşın</a>
            </div>
        </div>
    </section>
@endsection