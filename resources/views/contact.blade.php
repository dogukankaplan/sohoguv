@extends('layouts.app')

@section('content')
{{-- Modern Premium Contact Page --}}
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50">
    
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-20 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] pointer-events-none"></div>
        
        <div class="container-custom relative z-10">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Bize Ulaşın</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900">
                    <span class="bg-gradient-to-r from-brand-600 via-accent-600 to-brand-700 bg-clip-text text-transparent">
                        İletişime Geçin
                    </span>
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Güvenlik çözümlerimiz hakkında detaylı bilgi almak veya ücretsiz keşif hizmeti için bizimle iletişime geçin.
                </p>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="pb-20">
        <div class="container-custom">
            <div class="grid lg:grid-cols-5 gap-8 lg:gap-12">
                
                {{-- Contact Form - 3 columns --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6 sm:p-8 lg:p-10">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Mesaj Gönderin</h2>

                        @if(session('success'))
                            <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4 flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-slate-900 mb-2">Ad Soyad *</label>
                                    <input type="text" name="name" id="name" required 
                                           class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 transition-all text-slate-900 placeholder-slate-400"
                                           placeholder="Adınız Soyadınız">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-slate-900 mb-2">Telefon *</label>
                                    <input type="text" name="phone" id="phone" required
                                           class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 transition-all text-slate-900 placeholder-slate-400"
                                           placeholder="0555 123 45 67">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-900 mb-2">E-posta *</label>
                                <input type="email" name="email" id="email" required
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 transition-all text-slate-900 placeholder-slate-400"
                                       placeholder="ornek@email.com">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-semibold text-slate-900 mb-2">Konu</label>
                                <input type="text" name="subject" id="subject"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 transition-all text-slate-900 placeholder-slate-400"
                                       placeholder="Mesajınızın konusu">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-slate-900 mb-2">Mesajınız *</label>
                                <textarea name="message" id="message" rows="5" required
                                          class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-100 transition-all text-slate-900 placeholder-slate-400 resize-none"
                                          placeholder="Detaylı mesajınızı buraya yazın..."></textarea>
                                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-brand-600 text-white font-semibold hover:bg-brand-700 active:bg-brand-800 transition-all duration-200 shadow-lg hover:shadow-xl hover:shadow-brand-600/20">
                                <span>Mesajı Gönder</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Contact Info - 2 columns --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Contact Cards --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-100 flex items-center justify-center text-brand-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">Telefon</h3>
                                <a href="tel:{{ setting('phone', '+90 (555) 123 45 67') }}" class="text-slate-600 hover:text-brand-600 transition-colors">
                                    {{ setting('phone', '+90 (555) 123 45 67') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-accent-100 flex items-center justify-center text-accent-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">E-posta</h3>
                                <a href="mailto:{{ setting('email', 'info@sohoguvenlik.com') }}" class="text-slate-600 hover:text-brand-600 transition-colors">
                                    {{ setting('email', 'info@sohoguvenlik.com') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1">Adres</h3>
                                <p class="text-slate-600">{{ setting('address', 'Türkiye') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Working Hours --}}
                    <div class="bg-gradient-to-br from-brand-50 to-accent-50 rounded-2xl border border-brand-100 p-6">
                        <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Çalışma Saatleri
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Pazartesi - Cuma</span>
                                <span class="font-semibold text-slate-900 bg-white px-3 py-1 rounded-lg">09:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Cumartesi</span>
                                <span class="font-semibold text-slate-900 bg-white px-3 py-1 rounded-lg">09:00 - 14:00</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-600">Pazar</span>
                                <span class="font-semibold text-red-600 bg-white px-3 py-1 rounded-lg">Kapalı</span>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Features --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <h3 class="font-bold text-slate-900 mb-4">Neden Bizi Seçmelisiniz?</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-slate-600">24 saat içinde geri dönüş</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-slate-600">Ücretsiz keşif hizmeti</span>
                            </div>
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-slate-600">Profesyonel danışmanlık</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection