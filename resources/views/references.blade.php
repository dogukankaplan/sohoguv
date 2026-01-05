@extends('layouts.app')

@section('content')
    <div class="bg-slate-50 min-h-screen">
        {{-- Hero Section --}}
        <section class="relative py-24 lg:py-32 overflow-hidden bg-slate-900">
            {{-- Background Effects --}}
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:40px_40px]"></div>
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-accent-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: -2s;"></div>
            
            <div class="container-custom relative z-10 text-center max-w-4xl mx-auto space-y-8 animate-fade-in">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-brand-300 text-sm font-medium backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                    <span>Güçlü Referanslar</span>
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight tracking-tight">
                    Başarı Yolculuğumuzdaki
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-brand-400 via-accent-400 to-brand-500">Değerli İş Ortakları</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-slate-400 font-light leading-relaxed max-w-3xl mx-auto">
                    Türkiye'nin önde gelen kurum ve kuruluşlarına sunduğumuz güvenlik çözümleriyle gurur duyuyoruz.
                </p>
            </div>
        </section>

        {{-- Referanslar Grid --}}
        <section id="references" class="py-24 bg-white relative">
            <div class="container-custom">
                <div class="flex items-center gap-4 mb-12">
                     <div class="h-px bg-slate-200 flex-grow"></div>
                     <h2 class="text-2xl font-bold text-slate-900 px-4 py-2 rounded-xl bg-slate-50 border border-slate-100">Referanslarımız</h2>
                     <div class="h-px bg-slate-200 flex-grow"></div>
                </div>

                @if($clients->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                        @foreach($clients as $index => $client)
                            <div class="group relative bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-brand-500/10 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center h-40"
                                 style="animation-delay: {{ $index * 0.05 }}s;">
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="relative z-10 max-h-20 w-auto grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition duration-500 transform group-hover:scale-110">
                                @else
                                    <span class="relative z-10 text-lg font-bold text-slate-400 group-hover:text-brand-600 transition">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-300">
                        <p class="text-slate-400">Henüz referans eklenmemiş.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Partnerlerimiz Section --}}
        <section id="partners" class="py-24 bg-slate-50 relative overflow-hidden">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:24px_24px]"></div>
            
            <div class="container-custom relative z-10">
                <div class="flex items-center gap-4 mb-12">
                     <div class="h-px bg-slate-200 flex-grow"></div>
                     <h2 class="text-2xl font-bold text-slate-900 px-4 py-2 rounded-xl bg-white border border-slate-200">Partnerlerimiz</h2>
                     <div class="h-px bg-slate-200 flex-grow"></div>
                </div>

                @php
                    $partners = \App\Models\Partner::where('is_active', true)->orderBy('order')->get();
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($partners as $partner)
                    <div class="group relative bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 transition-all duration-300 flex items-center justify-center h-32">
                        <div class="absolute top-2 right-2 w-1.5 h-1.5 rounded-full bg-brand-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <img src="{{ Storage::url($partner->logo) }}" 
                             alt="{{ $partner->name }}" 
                             class="max-h-12 w-auto grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110">
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Çözüm Ortakları Section --}}
        <section id="solution-partners" class="py-24 bg-white relative">
            <div class="container-custom">
                <div class="flex items-center gap-4 mb-12">
                     <div class="h-px bg-slate-200 flex-grow"></div>
                     <h2 class="text-2xl font-bold text-slate-900 px-4 py-2 rounded-xl bg-slate-50 border border-slate-100">Çözüm Ortaklarımız</h2>
                     <div class="h-px bg-slate-200 flex-grow"></div>
                </div>

                @php
                    $solutionPartners = \App\Models\SolutionPartner::where('is_active', true)->orderBy('order')->get();
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($solutionPartners as $sp)
                    <div class="group relative bg-white rounded-3xl p-8 border border-slate-100 hover:border-brand-100 transition-all duration-300 hover:shadow-2xl hover:shadow-brand-900/5">
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-slate-50/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl pointer-events-none"></div>
                        <div class="relative z-10 flex items-center justify-center h-24">
                            <img src="{{ Storage::url($sp->logo) }}" 
                                 alt="{{ $sp->name }}" 
                                 class="max-h-16 w-auto grayscale group-hover:grayscale-0 opacity-70 group-hover:opacity-100 transition-all duration-500 group-hover:scale-110">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        @if(isset($testimonials) && $testimonials->count() > 0)
            <section class="py-24 bg-slate-50 border-t border-slate-200">
                <div class="container-custom">
                    <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold uppercase tracking-wider">
                            Gerçek Yorumlar
                        </div>
                        <h2 class="text-3xl md:text-5xl font-bold text-slate-900">Müşterilerimiz Ne Diyor?</h2>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <div class="flex items-center gap-1 text-amber-400 mb-6">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg> 
                                    @endfor
                                </div>

                                <p class="text-slate-600 italic mb-6 leading-relaxed relative z-10">"{!! $testimonial->content !!}"</p>

                                <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center font-bold text-white text-lg shadow-lg shadow-brand-500/20">
                                        {{ substr($testimonial->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900">{{ $testimonial->name }}</h4>
                                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">{{ $testimonial->company ?? 'Müşteri' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- CTA --}}
        <section class="py-24 bg-white">
            <div class="container-custom">
                <div class="relative rounded-[2.5rem] overflow-hidden bg-slate-900 px-6 py-24 text-center">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-600/20 via-transparent to-accent-600/20"></div>
                    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light"></div>
                    
                    <div class="relative z-10 max-w-3xl mx-auto space-y-10">
                        <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight">Siz de Mutlu Müşterilerimiz<br>Arasına Katılın</h2>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-white text-slate-900 font-bold hover:bg-brand-50 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                                Hemen Başlayın
                            </a>
                            <a href="tel:{{ setting('phone') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full border border-white/20 text-white font-bold hover:bg-white/10 transition-all duration-300">
                                Bizi Arayın
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection