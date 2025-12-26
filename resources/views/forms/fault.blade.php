@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-neutral-bg relative overflow-hidden flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
        {{-- Decorative Background Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -right-[10%] w-[70vh] h-[70vh] rounded-full bg-secondary-500/5 blur-3xl animate-pulse"
                style="animation-duration: 4s;"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[70vh] h-[70vh] rounded-full bg-accent-500/5 blur-3xl animate-pulse"
                style="animation-duration: 6s; animation-delay: 2s;"></div>
            <div class="absolute inset-0 opacity-[0.02]"
                style="background-image: linear-gradient(#0A1628 1px, transparent 1px), linear-gradient(90deg, #0A1628 1px, transparent 1px); background-size: 40px 40px;">
            </div>
        </div>

        <div
            class="relative w-full max-w-5xl bg-white rounded-3xl shadow-strong overflow-hidden flex flex-col md:flex-row animate-fade-in">
            {{-- Left: Visual Side --}}
            <div
                class="md:w-2/5 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 p-10 flex flex-col justify-between text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-64 h-64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="h-6 w-6 text-secondary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="font-bold tracking-wider uppercase text-sm text-secondary-400">Teknik Destek</span>
                    </div>

                    <h2 class="text-3xl font-bold mb-4">{{ setting('fault_form_title', 'Arıza Bildirim Formu') }}</h2>
                    <p class="text-primary-200 leading-relaxed mb-8">
                        {{ setting('fault_form_desc', 'Teknik ekibimiz en kısa sürede sorununuzu analiz edip size geri dönüş sağlayacaktır. Lütfen detayları eksiksiz paylaşın.') }}
                    </p>

                    <ul class="space-y-4 text-sm text-primary-200">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            7/24 Teknik Destek
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Hızlı Müdahale Garantisi
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Uzman Ekip
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 mt-12">
                    <div class="flex -space-x-2">
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-primary-900 grayscale opacity-70"
                            src="https://ui-avatars.com/api/?name=Teknik+Destek&background=random" alt="" />
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-primary-900 grayscale opacity-70"
                            src="https://ui-avatars.com/api/?name=U+E&background=random" alt="" />
                        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-primary-900 grayscale opacity-70"
                            src="https://ui-avatars.com/api/?name=S+G&background=random" alt="" />
                    </div>
                    <p class="text-xs text-primary-300 mt-2">Uzmanlarımız incelemek için bekliyor.</p>
                </div>
            </div>

            {{-- Right: Form Side --}}
            <div class="md:w-3/5 p-10 bg-white">
                @if(session('success'))
                    <div
                        class="mb-8 p-4 bg-green-50 border border-green-100 rounded-xl flex items-center gap-3 animate-fade-in">
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-green-800">Başarılı!</h4>
                            <p class="text-xs text-green-600">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="fault">

                    <div class="space-y-5">
                        <div class="group">
                            <label for="name" class="block text-sm font-bold text-primary-700 mb-1 ml-1">Ad Soyad /
                                Firma</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400 group-focus-within:text-secondary-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg pl-10 pr-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-secondary-500 focus:bg-white focus:ring-0 transition-all duration-200"
                                    placeholder="Örn: Ahmet Yılmaz">
                            </div>
                            @error('name') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="contact_info" class="block text-sm font-bold text-primary-700 mb-1 ml-1">İletişim
                                Bilgileri</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400 group-focus-within:text-secondary-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="contact_info" id="contact_info" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg pl-10 pr-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-secondary-500 focus:bg-white focus:ring-0 transition-all duration-200"
                                    placeholder="0555 555 5555 veya email@sirket.com">
                            </div>
                            @error('contact_info') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="details" class="block text-sm font-bold text-primary-700 mb-1 ml-1">Arıza
                                Detayı</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <textarea name="details" id="details" rows="4" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg px-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-secondary-500 focus:bg-white focus:ring-0 transition-all duration-200 resize-none"
                                    placeholder="Yaşadığınız sorunu detaylı bir şekilde açıklayınız..."></textarea>
                            </div>
                            @error('details') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full btn-primary py-4 text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            <span>{{ setting('btn_submit_request', 'Arıza Kaydı Oluştur') }}</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        <p class="mt-4 text-center text-xs text-neutral-400">
                            Bu form üzerinden gönderilen bilgiler 256-bit SSL ile korunmaktadır.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection