@extends('layouts.app')

@section('content')
{{-- "The Avant-Garde" High-End Agency Design --}}
{{-- Split Layout: Fixed Left (Brand/Hero) | Scrollable Right (Content/Form) --}}
<div class="min-h-screen bg-neutral-950 text-white selection:bg-brand-500 selection:text-white flex flex-col lg:flex-row overflow-hidden relative">

    {{-- Global Noise Overlay --}}
    <div class="fixed inset-0 pointer-events-none z-50 opacity-[0.04] mix-blend-overlay" style="background-image: url('https://grainy-gradients.vercel.app/noise.svg');"></div>

    {{-- LEFT SECTION (Fixed on Desktop) --}}
    <div class="lg:w-5/12 xl:w-[45%] lg:h-screen lg:fixed lg:top-0 lg:left-0 relative bg-neutral-900 overflow-hidden flex flex-col justify-between p-8 lg:p-16 border-r border-white/5">
        
        {{-- Background Gradients --}}
        <div class="absolute top-[-20%] right-[-20%] w-[80%] h-[80%] bg-brand-600/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[60%] h-[60%] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        {{-- Top: Brand/Nav Context --}}
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-white/40 hover:text-white transition-colors duration-300 text-sm tracking-widest uppercase font-bold mb-12">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Ana Sayfa
            </a>
            
            <h1 class="text-6xl lg:text-8xl font-black tracking-tighter leading-[0.9] mb-8">
                <span class="block text-transparent bg-clip-text bg-gradient-to-br from-white via-white to-white/50">LETS</span>
                <span class="block text-brand-500">TALK.</span>
            </h1>
            <p class="text-lg text-neutral-400 max-w-md font-light leading-relaxed">
                Bir sonraki büyük güvenlik projeniz için hazırız. <br>
                teknoloji, uzmanlık ve güvenin kesişim noktası.
            </p>
        </div>

        {{-- Bottom: Direct Contact --}}
        <div class="relative z-10 mt-12 lg:mt-0 space-y-8">
            <div class="space-y-2">
                <div class="text-xs font-bold text-neutral-500 uppercase tracking-widest">Hemen Arayın</div>
                <a href="tel:{{ setting('phone') }}" class="block text-3xl font-light hover:text-brand-400 transition-colors tracking-tight">{{ setting('phone') }}</a>
            </div>
            <div class="space-y-2">
                <div class="text-xs font-bold text-neutral-500 uppercase tracking-widest">E-Posta</div>
                <a href="mailto:{{ setting('email') }}" class="block text-xl font-light text-neutral-300 hover:text-white transition-colors underline decoration-neutral-700 underline-offset-4 hover:decoration-brand-500">{{ setting('email') }}</a>
            </div>
        </div>
    </div>

    {{-- RIGHT SECTION (Scrollable) --}}
    <div class="lg:w-7/12 xl:w-[55%] lg:ml-auto bg-neutral-950 relative">
        <div class="p-6 md:p-12 lg:p-20 max-w-4xl mx-auto space-y-24">

            {{-- 1. Contact Form --}}
            <section id="contact-form" class="space-y-10">
                <div class="flex items-center gap-4">
                    <span class="w-12 h-[1px] bg-brand-500"></span>
                    <h2 class="text-sm font-bold text-brand-500 uppercase tracking-widest">Proje İsteği</h2>
                </div>
                
                <div class="relative">
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-12">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-12">
                            <div class="group relative">
                                <input type="text" name="name" required class="block w-full bg-transparent border-b border-neutral-800 py-4 text-xl text-white focus:border-brand-500 focus:outline-none transition-colors peer placeholder-transparent" placeholder="Adınız">
                                <label class="absolute left-0 top-4 text-neutral-500 text-lg transition-all peer-focus:-top-6 peer-focus:text-xs peer-focus:text-brand-500 peer-placeholder-shown:top-4 peer-placeholder-shown:text-lg peer-[&:not(:placeholder-shown)]:-top-6 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-neutral-400 cursor-text">Ad Soyad</label>
                            </div>
                            <div class="group relative">
                                <input type="text" name="phone" required class="block w-full bg-transparent border-b border-neutral-800 py-4 text-xl text-white focus:border-brand-500 focus:outline-none transition-colors peer placeholder-transparent" placeholder="Telefon">
                                <label class="absolute left-0 top-4 text-neutral-500 text-lg transition-all peer-focus:-top-6 peer-focus:text-xs peer-focus:text-brand-500 peer-placeholder-shown:top-4 peer-placeholder-shown:text-lg peer-[&:not(:placeholder-shown)]:-top-6 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-neutral-400 cursor-text">Telefon No</label>
                            </div>
                        </div>

                        <div class="group relative">
                            <input type="email" name="email" required class="block w-full bg-transparent border-b border-neutral-800 py-4 text-xl text-white focus:border-brand-500 focus:outline-none transition-colors peer placeholder-transparent" placeholder="E-Posta">
                            <label class="absolute left-0 top-4 text-neutral-500 text-lg transition-all peer-focus:-top-6 peer-focus:text-xs peer-focus:text-brand-500 peer-placeholder-shown:top-4 peer-placeholder-shown:text-lg peer-[&:not(:placeholder-shown)]:-top-6 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-neutral-400 cursor-text">E-Posta Adresi</label>
                        </div>
                        
                        <div class="group relative">
                            <textarea name="message" rows="1" required class="block w-full bg-transparent border-b border-neutral-800 py-4 text-xl text-white focus:border-brand-500 focus:outline-none transition-colors peer placeholder-transparent resize-y min-h-[5rem]" placeholder="Mesajınız"></textarea>
                            <label class="absolute left-0 top-4 text-neutral-500 text-lg transition-all peer-focus:-top-6 peer-focus:text-xs peer-focus:text-brand-500 peer-placeholder-shown:top-4 peer-placeholder-shown:text-lg peer-[&:not(:placeholder-shown)]:-top-6 peer-[&:not(:placeholder-shown)]:text-xs peer-[&:not(:placeholder-shown)]:text-neutral-400 cursor-text">Size nasıl yardımcı olabiliriz?</label>
                        </div>

                        <button type="submit" class="group relative inline-flex items-center gap-4 px-8 py-4 bg-white text-neutral-950 rounded-full font-bold tracking-wide hover:bg-brand-500 hover:text-white transition-all duration-300">
                            <span>MESAJI GÖNDER</span>
                            <div class="w-8 h-8 rounded-full bg-neutral-950 text-white flex items-center justify-center group-hover:bg-white group-hover:text-brand-600 transition-colors">
                                <svg class="w-3 h-3 -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </button>
                    </form>
                </div>
            </section>

            {{-- 2. Locations Accordion --}}
            <section class="space-y-10">
                <div class="flex items-center gap-4">
                     <span class="w-12 h-[1px] bg-neutral-700"></span>
                    <h2 class="text-sm font-bold text-neutral-500 uppercase tracking-widest">Lokasyonlar</h2>
                </div>

                <div x-data="{ active: 'corporate' }" class="space-y-6">
                    {{-- Corporate Tab --}}
                    <div class="group cursor-pointer" @click="active = 'corporate'">
                        <div class="flex items-center justify-between pb-4 border-b border-neutral-800 group-hover:border-white transition-colors">
                            <h3 class="text-2xl font-light text-neutral-300 group-hover:text-white transition-colors">Kurumsal Merkez</h3>
                            <span class="text-2xl text-neutral-600 group-hover:text-white transition-colors" x-text="active === 'corporate' ? '−' : '+'"></span>
                        </div>
                        <div x-show="active === 'corporate'" x-collapse class="pt-6">
                             <div class="richness-text text-neutral-400 font-light leading-relaxed max-w-lg">
                                {!! setting('address_corporate', 'Adres bilgisi yükleniyor...') !!}
                             </div>
                        </div>
                    </div>

                    {{-- Technical Tab --}}
                    <div class="group cursor-pointer" @click="active = 'technical'">
                        <div class="flex items-center justify-between pb-4 border-b border-neutral-800 group-hover:border-white transition-colors">
                            <h3 class="text-2xl font-light text-neutral-300 group-hover:text-white transition-colors">Teknik Servis</h3>
                            <span class="text-2xl text-neutral-600 group-hover:text-white transition-colors" x-text="active === 'technical' ? '−' : '+'"></span>
                        </div>
                        <div x-show="active === 'technical'" x-collapse class="pt-6">
                             <div class="richness-text text-neutral-400 font-light leading-relaxed max-w-lg">
                                {!! setting('address_technical', 'Adres bilgisi yükleniyor...') !!}
                             </div>
                        </div>
                    </div>
                </div>

                {{-- Clean Map (Grayscale) --}}
                @if(setting('contact_map_iframe'))
                <div class="w-full aspect-[21/9] bg-neutral-900 grayscale hover:grayscale-0 transition-all duration-700 opacity-60 hover:opacity-100">
                    <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0 pointer-events-none hover:pointer-events-auto">
                        {!! setting('contact_map_iframe') !!}
                    </div>
                </div>
                @endif
            </section>

             {{-- 3. Banking (The "Vault" Grid) --}}
            <section class="space-y-10 pb-20">
                <div class="flex items-center gap-4">
                     <span class="w-12 h-[1px] bg-neutral-700"></span>
                    <h2 class="text-sm font-bold text-neutral-500 uppercase tracking-widest">Finansal Bilgiler</h2>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @php
                        $accounts = [];
                        $error = null;
                        try {
                            $accounts = \App\Models\BankAccount::where('is_active', true)->orderBy('order')->get();
                        } catch (\Exception $e) {
                            $error = $e->getMessage();
                        }
                    @endphp

                    @if($error)
                        <div class="md:col-span-2 p-6 border border-red-900/50 bg-red-900/10 text-red-400 font-mono text-xs">
                            <span class="block mb-2">[SYSTEM ERROR]</span>
                            DATABASE MIGRATION REQUIRED.
                        </div>
                    @elseif(count($accounts) > 0)
                        @foreach($accounts as $account)
                        {{-- Card Design --}}
                        <div class="group relative bg-neutral-900 border border-neutral-800 p-8 flex flex-col justify-between min-h-[220px] transition-all duration-500 hover:border-brand-500/50 hover:bg-neutral-800/50 hover:-translate-y-1 overflow-hidden">
                             {{-- Hover Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-br from-brand-500/0 via-transparent to-brand-500/0 group-hover:from-brand-500/5 group-hover:to-brand-500/5 transition-all duration-500"></div>
                            
                            <div class="relative z-10 flex justify-between items-start">
                                <div>
                                    <div class="text-neutral-500 text-[10px] uppercase tracking-widest mb-2 font-bold">{{ $account->currency }} ACCOUNT</div>
                                    <h3 class="text-xl text-white font-medium">{{ $account->bank_name }}</h3>
                                </div>
                                <div class="bg-white/5 p-2 rounded backdrop-blur-sm grayscale group-hover:grayscale-0 transition-all">
                                     @if($account->logo)
                                        <img src="{{ Storage::url($account->logo) }}" class="h-6 w-auto object-contain" alt="Logo">
                                    @else
                                        <span class="text-2xl">🏦</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="relative z-10 space-y-4">
                                <div>
                                    <div class="text-neutral-600 text-[10px] font-mono mb-1">IBAN NUMBER</div>
                                    <div class="font-mono text-sm text-neutral-300 tracking-wider group-hover:text-brand-400 transition-colors select-all">
                                        {{ $account->iban }}
                                    </div>
                                </div>
                                <div class="flex justify-between items-end border-t border-white/5 pt-4">
                                    <div>
                                        <div class="text-neutral-600 text-[10px] font-mono mb-0.5">BENEFICIARY</div>
                                        <div class="text-xs text-neutral-400 font-medium truncate max-w-[120px]">{{ $account->account_holder }}</div>
                                    </div>
                                    @if($account->branch_name)
                                    <div class="text-right">
                                        <div class="text-neutral-600 text-[10px] font-mono mb-0.5">BRANCH</div>
                                        <div class="text-xs text-neutral-400 font-medium">{{ $account->branch_name }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="md:col-span-2 py-12 text-center text-neutral-600 font-light">
                            Banka hesap bilgileri güncellenmektedir.
                        </div>
                    @endif
                </div>
            </section>

        </div>
    </div>
</div>

<style>
    .richness-text p { margin-bottom: 0.75rem; }
    .richness-text strong { color: white; font-weight: 600; }
</style>
@endsection