@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg min-h-screen">
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="max-w-2xl mx-auto text-center mb-16">
                    <h1 class="heading-xl mb-6">
                        {!! setting('contact_hero_title', '<span class="gradient-text">İletişime</span> Geçin') !!}
                    </h1>
                    <p class="text-body">
                        {{ setting('contact_hero_desc', 'Sorularınız için bize ulaşın. En kısa sürede size dönüş yapacağız.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    {{-- Contact Form --}}
                    <div class="card p-10">
                        <h2 class="text-2xl font-bold text-primary-500 mb-6">
                            {{ setting('contact_form_title', 'Mesaj Gönderin') }}</h2>

                        @if(session('success'))
                            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                                <p class="text-green-700 text-sm">{{ session('success') }}</p>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-sm font-semibold text-primary-500 mb-2">Ad Soyad
                                    *</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full rounded-lg border-neutral-light bg-white text-primary-500 px-4 py-3 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-primary-500 mb-2">E-posta
                                    *</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full rounded-lg border-neutral-light bg-white text-primary-500 px-4 py-3 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all">
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-primary-500 mb-2">Telefon</label>
                                <input type="text" name="phone" id="phone"
                                    class="w-full rounded-lg border-neutral-light bg-white text-primary-500 px-4 py-3 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-semibold text-primary-500 mb-2">Konu</label>
                                <input type="text" name="subject" id="subject"
                                    class="w-full rounded-lg border-neutral-light bg-white text-primary-500 px-4 py-3 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all">
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-primary-500 mb-2">Mesaj
                                    *</label>
                                <textarea name="message" id="message" rows="5" required
                                    class="w-full rounded-lg border-neutral-light bg-white text-primary-500 px-4 py-3 focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition-all"></textarea>
                                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="btn-primary w-full">
                                {{ setting('btn_submit', 'Mesajı Gönder') }}
                            </button>
                        </form>
                    </div>

                    {{-- Contact Info --}}
                    <div class="space-y-6">
                        <div class="card p-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-secondary-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-primary-500 mb-2">{{ setting('label_phone', 'Telefon') }}</h3>
                                    <p class="text-neutral-medium">{{ setting('phone', '+90 (555) 123 45 67') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card p-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-accent-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-accent-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-primary-500 mb-2">{{ setting('label_email', 'E-posta') }}</h3>
                                    <p class="text-neutral-medium">{{ setting('email', 'info@sohoguvenlik.com') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card p-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-secondary-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-secondary-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-primary-500 mb-2">{{ setting('label_address', 'Adres') }}</h3>
                                    <p class="text-neutral-medium">{{ setting('address', 'İstanbul, Türkiye') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection