@extends('layouts.app')

@section('content')

@foreach($sections as $section)
    @switch($section->type)
        @case('hero')
            {{-- Hero Section --}}
            <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-white pt-20">
                {{-- Dynamic Background Elements --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-cyan-100/40 to-cyan-50/0 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4 animate-float"></div>
                    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-purple-100/40 to-purple-50/0 rounded-full blur-3xl -translate-x-1/3 translate-y-1/4 animate-float" style="animation-delay: -2s;"></div>
                </div>

                <div class="container-custom relative z-10">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div class="space-y-8 text-center lg:text-left animate-slide-up">
                            <h1 class="font-bold tracking-tight text-gray-900 leading-none">
                                <span class="block text-[64px] lg:text-[100px] xl:text-[120px] bg-clip-text text-transparent bg-gradient-to-b from-gray-900 to-gray-600 pb-4">
                                    {{ $section->title ?? setting('hero_title', 'SOHO GÜVENLİK') }}
                                </span>
                            </h1>
                            <p class="text-xl lg:text-2xl text-gray-600 max-w-2xl mx-auto lg:mx-0 font-light leading-relaxed">
                                {{ $section->subtitle ?? setting('hero_subtitle', 'Yeni nesil güvenlik teknolojileri ile geleceğinizi koruma altına alın.') }}
                                {!! $section->content !!}
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                                <a href="{{ route('contact') }}" class="btn-gradient-primary group">
                                    <span>Hemen Teklif Alın</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                                <a href="{{ route('services.index') }}" class="btn-outline group">
                                    <span>Çözümlerimiz</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                            </div>

                            {{-- Trust Indicators --}}
                            <div class="pt-12 flex items-center justify-center lg:justify-start gap-8 opacity-60 grayscale hover:grayscale-0 transition duration-500">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="text-sm font-medium text-gray-500">7/24 Aktif Sistemler</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-cyan-500"></div>
                                    <span class="text-sm font-medium text-gray-500">Uzman Teknik Destek</span>
                                </div>
                            </div>
                        </div>

                        {{-- Hero Image / Dashboard Mockup --}}
                        <div class="relative lg:h-[700px] flex items-center justify-center animate-fade-in" style="animation-delay: 0.3s;">
                            @if($section->image)
                                <img src="{{ Storage::url($section->image) }}" alt="Hero Image" class="relative z-10 w-full rounded-3xl shadow-2xl border border-gray-100">
                            @else
                            <div class="relative z-10 w-full aspect-square max-w-[600px]">
                                {{-- Main Circle Image --}}
                                <div class="absolute inset-4 rounded-full overflow-hidden shadow-2xl border-8 border-white/50 backdrop-blur-sm">
                                    <img src="https://images.unsplash.com/photo-1557597774-9d273605dfa9?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover scale-110 hover:scale-100 transition duration-1000" alt="Security Dashboard">
                                    
                                    {{-- Overlay Gradient --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    
                                    {{-- Floating UI Card 1 --}}
                                    <div class="absolute bottom-12 left-12 bg-white/90 backdrop-blur-xl p-4 rounded-2xl shadow-strong border border-white/50 animate-float">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">Sistem Aktif</div>
                                                <div class="text-xs text-gray-500">Tüm sensörler devrede</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Decorative Rings --}}
                                <div class="absolute inset-0 rounded-full border border-cyan-500/10 scale-90 animate-pulse"></div>
                                <div class="absolute inset-0 rounded-full border border-purple-500/10 scale-110 animate-pulse" style="animation-delay: 1s;"></div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @break

        @case('stats')
            {{-- Stats Section --}}
            <div class="py-12 bg-gray-50 border-y border-gray-100">
                <div class="container-custom">
                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200/50">
                        @php
                            $stats = [
                                ['value' => setting('stat_1_value', '15+'), 'label' => setting('stat_1_label', 'Yıllık Tecrübe')],
                                ['value' => setting('stat_2_value', '1000+'), 'label' => setting('stat_2_label', 'Mutlu Müşteri')],
                                ['value' => setting('stat_3_value', '50+'), 'label' => setting('stat_3_label', 'Uzman Personel')],
                                ['value' => setting('stat_4_value', '81'), 'label' => setting('stat_4_label', 'İlde Hizmet')],
                            ];
                        @endphp
                        @foreach($stats as $stat)
                        <div class="text-center px-4 group">
                            <div class="stat-number group-hover:scale-110 transition-transform duration-300">{{ $stat['value'] }}</div>
                            <div class="stat-label">{{ $stat['label'] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @break

        @case('services')
            {{-- Services Section --}}
            <section class="section-padding relative overflow-hidden">
                <div class="container-custom">
                    <div class="text-center max-w-3xl mx-auto mb-20">
                        <h2 class="heading-hero-xl mb-6">
                            <span class="text-gradient">Akıllı Çözümlerimiz</span>
                        </h2>
                        <p class="text-body-lg">
                            İşletmeniz ve eviniz için en uygun, ölçeklenebilir ve güvenilir teknoloji altyapıları.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($services as $service)
                        <div class="card-gradient-border group">
                            <div class="p-8">
                                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mb-6 group-hover:bg-cyan-50 transition-colors duration-300">
                                    <img src="{{ $service->image ? Storage::url($service->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRz-k3qGvM3g1S-XgE1CgE22gX1jG1k9l5g9g&s' }}" class="w-8 h-8 opacity-60 group-hover:opacity-100 transition-opacity" alt="Icon">
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-cyan-600 transition-colors">{{ $service->title }}</h3>
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($service->content), 120) }}
                                </p>
                                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-sm font-bold text-gray-900 hover:text-cyan-600 transition-colors">
                                    Daha Fazla
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @break

        @case('features')
            {{-- Features Section --}}
            <section class="section-padding bg-gray-50 relative">
                <div class="container-custom">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <h2 class="heading-xl mb-8">Neden <span class="text-gradient">SOHO Güvenlik?</span></h2>
                            <div class="space-y-8">
                                @php
                                    $features = [
                                        ['title' => 'Ulusal Hizmet Ağı', 'desc' => 'Türkiye\'nin 81 ilinde kurulum ve teknik servis desteği.'],
                                        ['title' => 'Garantili İşçilik', 'desc' => 'Yapılan tüm montaj ve kurulumlarımız firma garantisi altındadır.'],
                                        ['title' => 'Hızlı Müdahale', 'desc' => 'Arıza durumunda 24 saat içerisinde teknik ekip yönlendirmesi.'],
                                    ];
                                @endphp
                                @foreach($features as $feature)
                                <div class="flex gap-6 group">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white shadow-soft flex items-center justify-center border border-gray-100 group-hover:border-cyan-200 transition-colors">
                                        <svg class="w-6 h-6 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h4>
                                        <p class="text-gray-600">{{ $feature['desc'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="relative">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="space-y-6 mt-12">
                                    <div class="card-modern bg-white p-6 animate-float">
                                        <div class="text-4xl font-bold text-cyan-500 mb-2">A+</div>
                                        <div class="text-gray-600 text-sm font-medium">Kalite Standartları</div>
                                    </div>
                                    <div class="img-ellipse h-64 w-full">
                                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" class="w-full h-full object-cover" alt="Team">
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="img-ellipse h-64 w-full">
                                        <img src="https://images.unsplash.com/photo-1581092921461-eab62e97a782?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Tech">
                                    </div>
                                    <div class="card-modern bg-white p-6 animate-float" style="animation-delay: -1s;">
                                        <div class="text-4xl font-bold text-purple-500 mb-2">20+</div>
                                        <div class="text-gray-600 text-sm font-medium">Global Marka Partneri</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @break

        @case('clients')
            {{-- Clients Section --}}
            <section class="py-20 bg-white border-t border-gray-100">
                <div class="container-custom">
                    <p class="text-center text-sm font-bold text-gray-400 uppercase tracking-widest mb-12">Güvenle Hizmet Verdiğimiz Markalar</p>
                    <div class="flex flex-wrap justify-center items-center gap-12 opacity-60">
                         @foreach($clients as $client)
                            <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="h-12 w-auto grayscale hover:grayscale-0 transition duration-300">
                        @endforeach
                        {{-- Fallback if no clients --}}
                        @if($clients->isEmpty())
                            <div class="text-gray-300 italic text-sm">Referans logoları eklenecek...</div>
                        @endif
                    </div>
                </div>
            </section>
            @break
            
        @case('testimonials')
             {{-- Testimonials --}}
             <section class="section-padding bg-gray-50">
                <div class="container-custom">
                    <h2 class="heading-xl text-center mb-16">Müşterilerimiz Ne Diyor?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                        <div class="card-modern p-8">
                            <div class="flex gap-1 text-amber-400 mb-6">
                                @for($i=0; $i<5; $i++) <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                            </div>
                            <p class="text-gray-600 mb-6 italic">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden">
                                     <img src="{{ $testimonial->image ? Storage::url($testimonial->image) : 'https://ui-avatars.com/api/?name='.urlencode($testimonial->name) }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ $testimonial->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $testimonial->company ?? 'Müşteri' }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
             </section>
            @break

        @case('cta')
            {{-- CTA Section --}}
            <section class="py-24 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-purple-600"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                <div class="container-custom relative z-10 text-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-8 tracking-tight">Güvenliğiniz İçin Profesyonel Çözüm Zamanı</h2>
                    <p class="text-xl text-cyan-100 mb-12 max-w-2xl mx-auto">Ücretsiz keşif hizmetimizden yararlanın, işletmeniz için en uygun güvenlik altyapısını birlikte planlayalım.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('quote') }}" class="px-8 py-4 rounded-full bg-white text-gray-900 font-bold hover:bg-gray-50 hover:scale-105 transition transform shadow-lg">Hızlı Teklif Al</a>
                        <a href="{{ route('contact') }}" class="px-8 py-4 rounded-full border-2 border-white text-white font-bold hover:bg-white/10 transition">İletişime Geç</a>
                    </div>
                </div>
            </section>
            @break
            
        @case('custom')
            {{-- Custom Content --}}
            @if($section->content)
                <section class="section-padding {{ $section->bg_color ?? 'bg-white' }}">
                    <div class="container-custom">
                         @if($section->title) <h2 class="heading-xl text-center mb-8">{{ $section->title }}</h2> @endif
                         <div class="prose prose-lg mx-auto max-w-4xl text-gray-600">
                             {!! $section->content !!}
                         </div>
                    </div>
                </section>
            @endif
            @break

    @endswitch
@endforeach

@endsection