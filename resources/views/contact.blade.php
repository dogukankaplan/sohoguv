@extends('layouts.app')

@section('content')
    <div class="relative min-h-screen bg-slate-900 text-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center mb-16">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl mb-4">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-soho-teal to-soho-purple">İletişime</span>
                    Geçin
                </h1>
                <p class="text-lg text-slate-400">Sorularınız için bize ulaşın. En kısa sürede size dönüş yapacağız.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                    <h2 class="text-2xl font-bold mb-6">Mesaj Gönderin</h2>

                    @if(session('success'))
                        <div class="mb-6 rounded-xl bg-green-500/10 border border-green-500/30 p-4">
                            <p class="text-green-400 text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-300 mb-2">Ad Soyad *</label>
                            <input type="text" name="name" id="name" required
                                class="w-full rounded-xl bg-slate-900 border-slate-600 text-white px-4 py-3 focus:border-soho-teal focus:ring-2 focus:ring-soho-teal/20 transition-all">
                            @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">E-posta *</label>
                            <input type="email" name="email" id="email" required
                                class="w-full rounded-xl bg-slate-900 border-slate-600 text-white px-4 py-3 focus:border-soho-teal focus:ring-2 focus:ring-soho-teal/20 transition-all">
                            @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-300 mb-2">Telefon</label>
                            <input type="text" name="phone" id="phone"
                                class="w-full rounded-xl bg-slate-900 border-slate-600 text-white px-4 py-3 focus:border-soho-teal focus:ring-2 focus:ring-soho-teal/20 transition-all">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-slate-300 mb-2">Konu</label>
                            <input type="text" name="subject" id="subject"
                                class="w-full rounded-xl bg-slate-900 border-slate-600 text-white px-4 py-3 focus:border-soho-teal focus:ring-2 focus:ring-soho-teal/20 transition-all">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-slate-300 mb-2">Mesaj *</label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full rounded-xl bg-slate-900 border-slate-600 text-white px-4 py-3 focus:border-soho-teal focus:ring-2 focus:ring-soho-teal/20 transition-all"></textarea>
                            @error('message') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-soho-teal to-soho-purple px-6 py-4 text-sm font-bold text-white shadow-lg hover:shadow-soho-purple/50 transition-all duration-300 hover:scale-105">
                            Mesajı Gönder
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-soho-teal/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-soho-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold mb-2">Telefon</h3>
                                <p class="text-slate-400">{{ $globalSettings['phone'] ?? '+90 (555) 123 45 67' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-soho-purple/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-soho-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold mb-2">E-posta</h3>
                                <p class="text-slate-400">{{ $globalSettings['email'] ?? 'info@sohoguvenlik.com' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-soho-teal/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-soho-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold mb-2">Adres</h3>
                                <p class="text-slate-400">{{ $globalSettings['address'] ?? 'İstanbul, Türkiye' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection