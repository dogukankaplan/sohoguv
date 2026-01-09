@extends('layouts.app')

@section('content')
    {{-- Modern Premium Contact Page --}}
    <div class="min-h-screen bg-slate-50">

        {{-- Hero Section --}}
        <section class="relative pt-32 pb-20 overflow-hidden bg-slate-900">
            {{-- Background Pattern --}}
            <div
                class="absolute inset-0 opacity-20 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] pointer-events-none">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-950/50"></div>

            <div class="container-custom relative z-10">
                <div class="max-w-3xl mx-auto text-center space-y-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-500/10 border border-brand-500/20 text-brand-400 text-sm font-medium backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Bize Ulaşın</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                        <span
                            class="bg-gradient-to-r from-brand-400 via-accent-400 to-brand-500 bg-clip-text text-transparent">
                            İletişime Geçin
                        </span>
                    </h1>
                    <p class="text-lg text-slate-400 leading-relaxed">
                        Güvenlik çözümlerimiz hakkında detaylı bilgi almak veya teknik destek için bize her zaman
                        ulaşabilirsiniz.
                    </p>
                </div>
            </div>
        </section>

        {{-- Map Section --}}
        @if(setting('contact_map_iframe'))
            <section class="h-[400px] w-full relative z-0">
                <div
                    class="absolute inset-0 w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0 grayscale hover:grayscale-0 transition-all duration-700">
                    {!! setting('contact_map_iframe') !!}
                </div>
            </section>
        @endif

        {{-- Main Content --}}
        <section class="py-20 relative -mt-20 z-10">
            <div class="container-custom">
                {{-- Contact Cards Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
                    {{-- Corporate Address --}}
                    <div
                        class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col items-center text-center">
                        <div
                            class="w-14 h-14 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Kurumsal Hizmet ve Operasyon</h3>
                        <div class="text-slate-600 text-sm leading-relaxed richness-text">
                            {!! setting('address_corporate', 'Henüz girilmemiş.') !!}
                        </div>
                    </div>

                    {{-- Technical Address --}}
                    <div
                        class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col items-center text-center">
                        <div
                            class="w-14 h-14 rounded-full bg-accent-50 text-accent-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Teknik Servis</h3>
                        <div class="text-slate-600 text-sm leading-relaxed richness-text">
                            {!! setting('address_technical', 'Henüz girilmemiş.') !!}
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div
                        class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col items-center text-center">
                        <div
                            class="w-14 h-14 rounded-full bg-green-50 text-green-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Telefon & WhatsApp</h3>
                        <a href="tel:{{ setting('phone') }}"
                            class="text-slate-600 hover:text-brand-600 transition-colors block">{{ setting('phone') }}</a>
                        <a href="mailto:{{ setting('email') }}"
                            class="text-slate-500 hover:text-brand-600 text-sm mt-1 block">{{ setting('email') }}</a>
                    </div>

                    {{-- Working Hours --}}
                    <div
                        class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col items-center text-center">
                        <div
                            class="w-14 h-14 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Çalışma Saatleri</h3>
                        <div class="text-slate-600 text-sm space-y-1">
                            <p>Hafta İçi: 09:00 - 18:00</p>
                            <p>Cumartesi: 09:00 - 14:00</p>
                        </div>
                    </div>
                </div>

                <div class="grid lg:grid-cols-5 gap-8 lg:gap-12">
                    {{-- Contact Form --}}
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 sm:p-8 lg:p-10">
                            <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                                <span class="w-1 h-8 rounded-full bg-brand-600"></span>
                                Mesaj Gönderin
                            </h2>

                            @if(session('success'))
                                <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <div class="grid sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">Ad Soyad *</label>
                                        <input type="text" name="name" required
                                            class="form-input w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-2">Telefon *</label>
                                        <input type="text" name="phone" required
                                            class="form-input w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">E-posta *</label>
                                    <input type="email" name="email" required
                                        class="form-input w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Konu</label>
                                    <input type="text" name="subject"
                                        class="form-input w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Mesajınız *</label>
                                    <textarea name="message" rows="4" required
                                        class="form-textarea w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-full py-3 text-lg">Mesajı Gönder</button>
                            </form>
                        </div>
                    </div>

                    {{-- Bank Accounts --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                                <h2 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                                    <span class="w-1 h-6 rounded-full bg-accent-600"></span>
                                    Banka Hesap Bilgileri
                                </h2>
                            </div>
                            <div class="divide-y divide-slate-100">
                                @php
                                    $accounts = \App\Models\BankAccount::where('is_active', true)->orderBy('order')->get();
                                @endphp

                                @forelse($accounts as $account)
                                    <div class="p-6 hover:bg-slate-50 transition-colors">
                                        <div class="flex items-center gap-4 mb-3">
                                            @if($account->logo)
                                                <img src="{{ Storage::url($account->logo) }}" alt="{{ $account->bank_name }}"
                                                    class="w-12 h-12 object-contain bg-white rounded-lg border border-slate-100 p-1">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="font-bold text-slate-900">{{ $account->bank_name }}</h3>
                                                <p class="text-sm text-slate-500">{{ $account->currency }} Hesabı</p>
                                            </div>
                                        </div>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex justify-between py-1 border-b border-slate-50 group">
                                                <span class="text-slate-500">Şube:</span>
                                                <span
                                                    class="font-medium text-slate-900 select-all">{{ $account->branch_name }}</span>
                                            </div>
                                            <div class="flex justify-between py-1 border-b border-slate-50 group">
                                                <span class="text-slate-500">Alıcı:</span>
                                                <span
                                                    class="font-medium text-slate-900 select-all text-right">{{ $account->account_holder }}</span>
                                            </div>
                                            <div class="pt-2">
                                                <span class="text-xs text-slate-400 block mb-1">IBAN:</span>
                                                <div
                                                    class="font-mono font-medium text-slate-900 bg-slate-50 p-2 rounded border border-slate-100 select-all tracking-wide break-all">
                                                    {{ $account->iban }}
                                                </div>
                                            </div>
                                            @if($account->swift_code)
                                                <div class="pt-1">
                                                    <span class="text-xs text-slate-400 text-right">SWIFT:
                                                        {{ $account->swift_code }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-8 text-center text-slate-500">
                                        Henüz banka hesabı eklenmemiş.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection