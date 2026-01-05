@extends('layouts.app')

@section('content')
    {{-- Expert Services Index Redesign --}}
    <div class="min-h-screen bg-gradient-to-br from-white via-slate-50/50 to-white">

        {{-- Hero Section --}}
        <section class="relative pt-32 pb-20 overflow-hidden">
            {{-- Background Elements --}}
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] pointer-events-none">
            </div>
            <div class="absolute top-20 right-[10%] w-96 h-96 bg-brand-400/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 left-[15%] w-80 h-80 bg-accent-400/10 rounded-full blur-3xl animate-float"
                style="animation-delay: -2s;"></div>

            <div class="container-custom relative z-10">
                <div class="max-w-4xl mx-auto text-center space-y-8">
                    {{-- Badge --}}
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>Profesyonel Hizmetler</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                        <span
                            class="bg-gradient-to-r from-brand-600 via-accent-600 to-brand-700 bg-clip-text text-transparent">
                            Hizmetlerimiz
                        </span>
                    </h1>

                    {{-- Description --}}
                    <p class="text-lg sm:text-xl text-slate-600 leading-relaxed max-w-3xl mx-auto">
                        İşletmeniz için güvenlik, teknoloji ve altyapı çözümlerinde tam hizmet. Keşif'ten kuruluma,
                        bakım'dan destek'e her aşamada yanınızdayız.
                    </p>

                    {{-- Quick Stats --}}
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 pt-4">
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-brand-600">{{ $services->count() }}</div>
                            <div class="text-xs sm:text-sm text-slate-600 mt-1">Hizmet Alanı</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-brand-600">24/7</div>
                            <div class="text-xs sm:text-sm text-slate-600 mt-1">Teknik Destek</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-brand-600">81</div>
                            <div class="text-xs sm:text-sm text-slate-600 mt-1">İlde Hizmet</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Services Bento Grid --}}
        <section class="pb-20 lg:pb-32">
            <div class="container-custom">
                {{-- Filter/Category Tags (Optional Future Enhancement) --}}
                <div class="flex flex-wrap gap-3 justify-center mb-12 lg:mb-16">
                    <button class="px-5 py-2 rounded-full bg-brand-600 text-white text-sm font-semibold shadow-lg">
                        Tümü
                    </button>
                    <button
                        class="px-5 py-2 rounded-full bg-white text-slate-700 text-sm font-medium border border-slate-200 hover:border-brand-300 hover:bg-slate-50 transition-all">
                        Güvenlik Sistemleri
                    </button>
                    <button
                        class="px-5 py-2 rounded-full bg-white text-slate-700 text-sm font-medium border border-slate-200 hover:border-brand-300 hover:bg-slate-50 transition-all">
                        Ağ & Altyapı
                    </button>
                    <button
                        class="px-5 py-2 rounded-full bg-white text-slate-700 text-sm font-medium border border-slate-200 hover:border-brand-300 hover:bg-slate-50 transition-all">
                        Danışmanlık
                    </button>
                </div>

                {{-- Services Grid with Stagger Animation --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($services as $index => $service)
                        @php
                            $colors = [
                                ['from' => 'brand-500', 'to' => 'brand-700', 'accent' => 'brand', 'bg' => 'brand-50'],
                                ['from' => 'accent-500', 'to' => 'accent-700', 'accent' => 'accent', 'bg' => 'accent-50'],
                                ['from' => 'amber-500', 'to' => 'amber-700', 'accent' => 'amber', 'bg' => 'amber-50'],
                                ['from' => 'brand-600', 'to' => 'accent-600', 'accent' => 'brand', 'bg' => 'brand-50'],
                                ['from' => 'accent-600', 'to' => 'brand-600', 'accent' => 'accent', 'bg' => 'accent-50'],
                                ['from' => 'amber-600', 'to' => 'brand-600', 'accent' => 'amber', 'bg' => 'amber-50'],
                            ];
                            $color = $colors[$index % 6];
                            $delay = ($index % 3) * 0.1; // Stagger delay
                        @endphp

                        <a href="{{ route('services.show', $service->slug) }}"
                            class="group relative bg-white rounded-3xl border border-slate-200 hover:border-{{ $color['accent'] }}-300 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-{{ $color['accent'] }}-500/10 hover:-translate-y-1"
                            style="animation: slideInUp 0.6s ease-out {{ $delay }}s backwards;">

                            {{-- Gradient Overlay --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-{{ $color['from'] }}/0 to-{{ $color['to'] }}/0 group-hover:from-{{ $color['from'] }}/5 group-hover:to-{{ $color['to'] }}/5 transition-all duration-500">
                            </div>

                            <div class="relative p-8">
                                {{-- Icon/Image --}}
                                <div class="mb-6">
                                    @if($service->image)
                                        <div
                                            class="relative w-20 h-20 rounded-2xl bg-gradient-to-br from-{{ $color['from'] }}/10 to-{{ $color['to'] }}/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}"
                                                loading="lazy"
                                                class="w-12 h-12 object-contain opacity-70 group-hover:opacity-100 transition-opacity">
                                        </div>
                                    @else
                                        <div
                                            class="relative w-20 h-20 rounded-2xl bg-gradient-to-br from-{{ $color['from'] }}/10 to-{{ $color['to'] }}/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-{{ $color['from'] }} to-{{ $color['to'] }} rounded-2xl blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                                            </div>
                                            <svg class="relative w-12 h-12 text-{{ $color['accent'] }}-600" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3
                                    class="text-xl lg:text-2xl font-bold text-slate-900 mb-3 group-hover:text-{{ $color['accent'] }}-600 transition-colors">
                                    {{ $service->title }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-slate-600 text-sm lg:text-base leading-relaxed mb-6 line-clamp-3">
                                    {{ Str::limit(strip_tags($service->content), 140) }}
                                </p>

                                {{-- Features/Benefits (if available) --}}
                                @if($service->features ?? false)
                                    <div class="mb-6 space-y-2">
                                        @foreach(array_slice(explode("\n", $service->features), 0, 3) as $feature)
                                            <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-{{ $color['accent'] }}-600 mt-0.5 flex-shrink-0" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="text-xs text-slate-600">{{ trim($feature) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- CTA --}}
                                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                    <span
                                        class="text-sm font-semibold text-{{ $color['accent'] }}-600 group-hover:gap-3 inline-flex items-center gap-2 transition-all">
                                        Detaylı İncele
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </span>

                                    {{-- Visual Indicator --}}
                                    <div
                                        class="w-2 h-2 rounded-full bg-{{ $color['accent'] }}-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Empty State --}}
                @if($services->isEmpty())
                    <div class="text-center py-20">
                        <div class="w-20 h-20 bg-slate-100 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <svg class="w-10 h-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Henüz Hizmet Eklenmemiş</h3>
                        <p class="text-slate-600">Admin panelinden hizmet ekleyebilirsiniz.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="py-16 lg:py-20">
            <div class="container-custom">
                <div
                    class="relative bg-gradient-to-br from-brand-600 via-brand-700 to-accent-600 rounded-3xl overflow-hidden">
                    {{-- Background Pattern --}}
                    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20">
                    </div>

                    <div class="relative px-8 py-16 lg:py-20 text-center">
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-6">
                            İhtiyacınıza Özel Çözüm Arıyor musunuz?
                        </h2>
                        <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto">
                            Uzman ekibimiz, işletmeniz için en uygun güvenlik ve teknoloji altyapısını oluşturmanıza
                            yardımcı olur.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white text-brand-700 font-semibold hover:bg-slate-50 transition-all shadow-lg hover:shadow-xl">
                                <span>Ücretsiz Danışmanlık</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="tel:{{ setting('phone') }}"
                                class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-sm text-white font-semibold border-2 border-white/20 hover:bg-white/20 transition-all">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>Hemen Arayın</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Animation Keyframes --}}
    <style>
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection