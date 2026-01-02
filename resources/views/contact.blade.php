@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen">
        <section class="section-padding bg-gradient-subtle">
            <div class="container-custom">
                <div class="max-w-4xl mx-auto text-center mb-16 space-y-6 animate-fade-in">
                    <p class="text-sm font-bold text-cyan-600 uppercase tracking-wider">İletişim</p>
                    <h1 class="heading-xl">
                        <span class="text-gradient">İletişime</span> Geçin
                    </h1>
                    <p class="text-body-lg">
                        {{ setting('contact_hero_desc', 'Sorularınız için bize ulaşın. En kısa sürede size dönüş yapacağız.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    {{-- Contact Form --}}
                    <div class="card-modern">
                        <h2 class="heading-md mb-6">
                            {{ setting('contact_form_title', 'Mesaj Gönderin') }}
                        </h2>

                        @if(session('success'))
                            <div class="mb-6 rounded-2xl bg-green-50 border border-green-200 p-4">
                                <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Ad Soyad *</label>
                                <input type="text" name="name" id="name" required class="input-pill">
                                @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">E-posta *</label>
                                <input type="email" name="email" id="email" required class="input-pill">
                                @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">Telefon</label>
                                <input type="text" name="phone" id="phone" class="input-pill">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-900 mb-2">Konu</label>
                                <input type="text" name="subject" id="subject" class="input-pill">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">Mesaj *</label>
                                <textarea name="message" id="message" rows="5" required class="textarea-modern"></textarea>
                                @error('message') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="btn-gradient-primary w-full">
                                {{ setting('btn_submit', 'Mesajı Gönder') }}
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    {{-- Contact Info --}}
                    <div class="space-y-6">
                        <div class="card-gradient-border">
                            <div class="flex items-start gap-4">
                                <div class="icon-circle-gradient flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">{{ setting('label_phone', 'Telefon') }}</h3>
                                    <p class="text-gray-600">{{ setting('phone', '+90 (555) 123 45 67') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-gradient-border">
                            <div class="flex items-start gap-4">
                                <div class="icon-circle-gradient flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">{{ setting('label_email', 'E-posta') }}</h3>
                                    <p class="text-gray-600">{{ setting('email', 'info@sohoguvenlik.com') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-gradient-border">
                            <div class="flex items-start gap-4">
                                <div class="icon-circle-gradient flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 mb-2">{{ setting('label_address', 'Adres') }}</h3>
                                    <p class="text-gray-600">{{ setting('address', 'Türkiye') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Working Hours --}}
                        <div class="card-modern bg-gray-50">
                            <h3 class="font-bold text-gray-900 mb-4">Çalışma Saatleri</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pazartesi - Cuma</span>
                                    <span class="font-semibold text-gray-900">09:00 - 18:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Cumartesi</span>
                                    <span class="font-semibold text-gray-900">09:00 - 14:00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Pazar</span>
                                    <span class="font-semibold text-gray-900">Kapalı</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection