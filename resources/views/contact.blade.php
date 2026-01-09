@extends('layouts.app')

@section('content')
{{-- "Tier-1 Enterprise" Clean Corporate Design --}}
<div class="min-h-screen bg-white text-slate-800 selection:bg-brand-600 selection:text-white relative overflow-hidden">

    {{-- Subtle Background Geometric Accents --}}
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-slate-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-brand-50/50 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Hero Header --}}
    <section class="relative pt-32 pb-16 px-6 lg:px-12 border-b border-slate-100">
        <div class="container-custom max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="space-y-6 max-w-3xl">
                    <div class="inline-flex items-center gap-2 pl-1 pr-3 py-1 rounded-full bg-slate-100/80 border border-slate-200 text-slate-600 text-xs font-bold uppercase tracking-widest">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                        İletişim
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold tracking-tight text-slate-900 leading-[1.1]">
                        Bize <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-800">Ulaşın.</span>
                    </h1>
                    <p class="text-xl text-slate-500 font-light max-w-2xl leading-relaxed">
                        Projenizi dinlemek, sorularınızı yanıtlamak ve size en uygun güvenlik çözümlerini sunmak için buradayız.
                    </p>
                </div>
                {{-- Quick Stats / Contact Points --}}
                <div class="flex gap-4 lg:gap-8">
                    <a href="tel:{{ setting('phone') }}" class="group flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                        <div class="w-12 h-12 rounded-full bg-brand-600 text-white flex items-center justify-center shadow-lg shadow-brand-200 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Bizi Arayın</div>
                            <div class="font-semibold text-slate-900">{{ setting('phone') }}</div>
                        </div>
                    </a>
                    <a href="mailto:{{ setting('email') }}" class="group flex items-center gap-4 p-4 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                         <div class="w-12 h-12 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">E-Posta</div>
                            <div class="font-semibold text-slate-900">{{ setting('email') }}</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Layout: Grid System --}}
    <section class="py-20 px-6 lg:px-12">
        <div class="container-custom max-w-4xl mx-auto lg:max-w-7xl">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
                
                {{-- LEFT: Contact Form (7 cols) --}}
                <div class="lg:col-span-7">
                    <div class="mb-10">
                        <h2 class="text-3xl font-bold text-slate-900 mb-4">İleti Gönderin</h2>
                        <p class="text-slate-500">Formu doldurun, uzman ekibimiz en kısa sürede sizinle iletişime geçsin.</p>
                    </div>

                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" class="mb-8 p-5 rounded-lg bg-green-50 border border-green-100 text-green-700 flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span class="font-medium">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="hover:text-green-900"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide group-focus-within:text-brand-600 transition-colors">Ad Soyad</label>
                                <input type="text" name="name" required class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 px-0 py-3 text-slate-900 focus:ring-0 focus:border-brand-600 placeholder-slate-400 transition-all font-medium text-lg" placeholder="Adınız Soyadınız">
                            </div>
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide group-focus-within:text-brand-600 transition-colors">Telefon</label>
                                <input type="text" name="phone" required class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 px-0 py-3 text-slate-900 focus:ring-0 focus:border-brand-600 placeholder-slate-400 transition-all font-medium text-lg" placeholder="05XX XXX XX XX">
                            </div>
                        </div>
                        <div class="group">
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide group-focus-within:text-brand-600 transition-colors">E-Posta</label>
                            <input type="email" name="email" required class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 px-0 py-3 text-slate-900 focus:ring-0 focus:border-brand-600 placeholder-slate-400 transition-all font-medium text-lg" placeholder="ornek@sirket.com">
                        </div>
                        <div class="group">
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide group-focus-within:text-brand-600 transition-colors">Konu</label>
                            <input type="text" name="subject" class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 px-0 py-3 text-slate-900 focus:ring-0 focus:border-brand-600 placeholder-slate-400 transition-all font-medium text-lg" placeholder="Proje Talebi">
                        </div>
                        <div class="group">
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide group-focus-within:text-brand-600 transition-colors">Mesajınız</label>
                            <textarea name="message" rows="3" required class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 px-0 py-3 text-slate-900 focus:ring-0 focus:border-brand-600 placeholder-slate-400 transition-all font-medium text-lg resize-none" placeholder="Mesajınızı buraya yazınız..."></textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-full font-bold hover:bg-brand-600 transition-colors duration-300 shadow-xl hover:shadow-brand-200">
                                <span>Gönder</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RIGHT: Info Sidebar (5 cols) --}}
                <div class="lg:col-span-5 space-y-12">
                    
                    {{-- Addresses --}}
                    <div class="space-y-8">
                        {{-- Corporate --}}
                        <div class="pl-6 border-l-4 border-slate-200 hover:border-brand-600 transition-colors group">
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 group-hover:text-brand-600 transition-colors">Kurumsal Merkez</h3>
                            <div class="richness-text text-slate-600 leading-relaxed font-normal">
                                {!! setting('address_corporate', 'Adres bilgisi yükleniyor...') !!}
                            </div>
                        </div>
                        
                        {{-- Technical --}}
                        <div class="pl-6 border-l-4 border-slate-200 hover:border-brand-600 transition-colors group">
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 group-hover:text-brand-600 transition-colors">Teknik Servis</h3>
                            <div class="richness-text text-slate-600 leading-relaxed font-normal">
                                {!! setting('address_technical', 'Adres bilgisi yükleniyor...') !!}
                            </div>
                        </div>
                    </div>

                    {{-- Map Preview --}}
                    @if(setting('contact_map_iframe'))
                    <div class="rounded-2xl overflow-hidden shadow-2xl border border-slate-200 aspect-video grayscale hover:grayscale-0 transition-all duration-500">
                        <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                            {!! setting('contact_map_iframe') !!}
                        </div>
                    </div>
                    @endif

                    {{-- Bank Accounts: Clean Table Style --}}
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                        <h3 class="font-bold text-slate-900 mb-6 flex items-center gap-2">
                             <span class="p-1 bg-slate-200 rounded text-slate-600"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg></span>
                            Banka Hesapları
                        </h3>
                        
                        <div class="space-y-4">
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
                                <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 text-amber-700 text-sm">
                                    <strong>Kurulum Gerekli:</strong> Veritabanı tabloları bulunamadı.<br>
                                    Lütfen VPS panelinden <code>php artisan migrate</code> komutunu çalıştırın.
                                </div>
                            @elseif(count($accounts) > 0)
                                @foreach($accounts as $account)
                                    <div class="bg-white p-4 rounded-xl border border-slate-200 hover:border-brand-200 hover:shadow-md transition-all group">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex items-center gap-3">
                                                 @if($account->logo)
                                                    <img src="{{ Storage::url($account->logo) }}" class="h-6 w-auto object-contain" alt="">
                                                @else
                                                   <span class="text-slate-400 font-bold">{{ $account->bank_name }}</span>
                                                @endif
                                                <span class="text-xs font-bold text-slate-400 py-0.5 px-2 bg-slate-100 rounded">{{ $account->currency }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-2">
                                            <div class="flex flex-col">
                                                <span class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">IBAN</span>
                                                <span class="font-mono text-sm text-slate-700 select-all">{{ $account->iban }}</span>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                 <div>
                                                    <span class="text-[10px] uppercase text-slate-400 font-bold tracking-wider block">Alıcı</span>
                                                    <span class="text-xs font-medium text-slate-900 truncate block">{{ $account->account_holder }}</span>
                                                </div>
                                                @if($account->branch_name)
                                                <div class="text-right">
                                                    <span class="text-[10px] uppercase text-slate-400 font-bold tracking-wider block">Şube</span>
                                                    <span class="text-xs font-medium text-slate-900">{{ $account->branch_name }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4 text-slate-400 text-sm italic">
                                    Henüz banka hesabı eklenmemiş.
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .richness-text p { margin-bottom: 0.5rem; }
    .richness-text strong { color: #0f172a; font-weight: 700; }
</style>
@endsection