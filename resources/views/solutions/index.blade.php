@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden bg-white">
        {{-- Abstract Background Shapes --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div
                class="absolute top-0 left-0 w-[600px] h-[600px] bg-gradient-to-br from-gray-50 to-cyan-50/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-70">
            </div>
            <div
                class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-gradient-to-tl from-gray-50 to-purple-50/20 rounded-full blur-3xl translate-x-1/4 translate-y-1/4 opacity-70">
            </div>
        </div>

        <div class="container-custom relative z-10 text-center animate-fade-in">
            <h1 class="font-bold text-gray-900 mb-6 leading-tight">
                <span class="block text-4xl lg:text-6xl mb-2">Kurumsal</span>
                <span
                    class="block text-5xl lg:text-7xl bg-clip-text text-transparent bg-gradient-to-r from-cyan-600 to-purple-600">Çözümlerimiz</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                İşletmenizin ihtiyaçlarına özel, uçtan uca entegre güvenlik ve teknoloji altyapıları tasarlıyoruz.
            </p>
        </div>
    </section>

    {{-- Solutions Grid --}}
    <section class="py-24 bg-white">
        <div class="container-custom">

            @if($services->isEmpty())
                <div class="text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                    <p class="text-gray-500 text-lg">Henüz çözüm eklenmemiş.</p>
                    <p class="text-sm text-gray-400 mt-2">Admin panelden hizmet/çözüm ekleyebilirsiniz.</p>
                </div>
            @else
                <div class="space-y-32">
                    @foreach($services as $service)
                        <div class="group flex flex-col {{ $loop->even ? 'lg:flex-row-reverse' : 'lg:flex-row' }} items-center gap-12 lg:gap-20"
                            data-aos="fade-up">

                            {{-- Image Side --}}
                            <div class="w-full lg:w-1/2 relative">
                                <div
                                    class="relative rounded-[2rem] overflow-hidden shadow-2xl aspect-[4/3] group-hover:shadow-[0_20px_50px_rgba(8,145,178,0.3)] transition-all duration-500">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-tr from-gray-900/20 to-transparent pointer-events-none z-10">
                                    </div>
                                    <img src="{{ $service->image ? Storage::url($service->image) : 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2070&auto=format&fit=crop' }}"
                                        alt="{{ $service->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">

                                    {{-- Floating Badge --}}
                                    <div
                                        class="absolute top-6 right-6 z-20 bg-white/90 backdrop-blur px-4 py-2 rounded-full font-bold text-gray-900 text-sm shadow-lg">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}. Çözüm
                                    </div>
                                </div>

                                {{-- Decor Elements --}}
                                <div
                                    class="absolute -bottom-6 -right-6 w-24 h-24 bg-gray-100 rounded-full -z-10 group-hover:bg-cyan-50 transition-colors duration-500">
                                </div>
                                <div
                                    class="absolute -top-6 -left-6 w-32 h-32 border-2 border-gray-100 rounded-full -z-10 group-hover:border-cyan-100 transition-colors duration-500">
                                </div>
                            </div>

                            {{-- Content Side --}}
                            <div class="w-full lg:w-1/2">
                                <h2
                                    class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 group-hover:text-cyan-600 transition-colors">
                                    {{ $service->title }}</h2>
                                <div class="w-20 h-1.5 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-full mb-8"></div>

                                <div class="prose prose-lg text-gray-600 mb-8 line-clamp-4">
                                    {!! strip_tags($service->content) !!}
                                </div>

                                <div class="flex flex-wrap gap-4">
                                    <a href="{{ route('services.show', $service->slug) }}"
                                        class="inline-flex items-center px-8 py-4 rounded-xl bg-gray-900 text-white font-medium hover:bg-cyan-600 transition-all shadow-lg hover:shadow-cyan-500/30 transform hover:-translate-y-1">
                                        Detaylı İncele
                                        <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('quote') }}"
                                        class="inline-flex items-center px-8 py-4 rounded-xl bg-gray-100 text-gray-700 font-medium hover:bg-gray-200 transition-colors">
                                        Teklif Al
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- Stats / Trust Section --}}
    <section class="py-24 bg-gray-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-[600px] h-[600px] bg-cyan-500/20 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2">
        </div>

        <div class="container-custom relative z-10">
            <div class="grid md:grid-cols-3 gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-gray-800">
                <div class="p-4">
                    <div
                        class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-400 mb-2">
                        500+</div>
                    <div class="text-gray-400 font-medium">Tamamlanan Proje</div>
                </div>
                <div class="p-4">
                    <div
                        class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-400 mb-2">
                        %98</div>
                    <div class="text-gray-400 font-medium">Müşteri Memnuniyeti</div>
                </div>
                <div class="p-4">
                    <div
                        class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-400 mb-2">
                        24/7</div>
                    <div class="text-gray-400 font-medium">Kesintisiz Destek</div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-gray-50">
        <div class="container-custom">
            <div
                class="bg-white rounded-[3rem] p-12 md:p-20 text-center shadow-xl border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-cyan-500 via-purple-500 to-amber-500">
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Projeniz İçin Hazırız</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10">Kurumsal güvenlik ve teknoloji ihtiyaçlarınız için
                    ücretsiz keşif ve danışmanlık hizmetimizden yararlanın.</p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center px-10 py-5 rounded-full bg-gray-900 text-white font-bold hover:bg-cyan-600 transition-colors shadow-lg hover:shadow-cyan-500/30 transform hover:-translate-y-1">
                    Bize Ulaşın
                    <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection