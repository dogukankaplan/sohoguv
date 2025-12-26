@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-neutral-bg relative overflow-hidden flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        {{-- Decorative Background Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 right-0 w-[50vh] h-[50vh] bg-secondary-500/5 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[50vh] h-[50vh] bg-primary-500/5 rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div class="relative w-full max-w-5xl bg-white rounded-2xl shadow-strong overflow-hidden flex flex-col md:flex-row">
            {{-- Left: Visual Side --}}
            <div
                class="md:w-2/5 bg-primary-900 p-8 lg:p-12 flex flex-col justify-between text-white relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;">
                </div>

                <div class="relative z-10">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full border border-white/10 backdrop-blur-sm mb-6">
                        <span class="w-2 h-2 rounded-full bg-secondary-400 animate-pulse"></span>
                        <span class="text-xs font-medium tracking-wide uppercase text-white/90">Teknik Destek</span>
                    </div>

                    <h2 class="text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                        {{ setting('fault_form_title', 'Arıza Bildirim Formu') }}</h2>
                    <p class="text-primary-100/80 leading-relaxed mb-8">
                        {{ setting('fault_form_desc', 'Teknik ekibimiz en kısa sürede sorununuzu analiz edip size geri dönüş sağlayacaktır. Lütfen detayları eksiksiz paylaşın.') }}
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 border border-white/5">
                            <svg class="w-5 h-5 text-secondary-400 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-sm">Hızlı Müdahale</h4>
                                <p class="text-xs text-white/60">Öncelikli teknik destek sırası</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 border border-white/5">
                            <svg class="w-5 h-5 text-secondary-400 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="font-semibold text-sm">Uzman Çözüm</h4>
                                <p class="text-xs text-white/60">Sertifikalı teknisyenler</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 mt-12 pt-6 border-t border-white/10">
                    <p class="text-xs text-white/50">
                        &copy; {{ date('Y') }} SOHO Güvenlik Sistemleri
                    </p>
                </div>
            </div>

            {{-- Right: Form Side --}}
            <div class="md:w-3/5 p-8 lg:p-12 bg-white">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-lg flex items-start gap-3">
                        <svg class="h-5 w-5 text-green-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="text-sm font-semibold text-green-800">Başarılı</h4>
                            <p class="text-sm text-green-600">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="fault">

                    <div class="grid gap-6">
                        <div class="space-y-1.5">
                            <label for="name" class="text-sm font-medium text-primary-700">Ad Soyad / Firma</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" required
                                    class="block w-full rounded-lg border-neutral-light bg-neutral-bg/50 pl-10 pr-4 py-3 text-sm text-primary-900 placeholder-neutral-400 focus:border-secondary-500 focus:bg-white focus:ring-1 focus:ring-secondary-500 transition-colors"
                                    placeholder="Örn: Ahmet Yılmaz">
                            </div>
                            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="contact_info" class="text-sm font-medium text-primary-700">İletişim
                                Bilgileri</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="contact_info" id="contact_info" required
                                    class="block w-full rounded-lg border-neutral-light bg-neutral-bg/50 pl-10 pr-4 py-3 text-sm text-primary-900 placeholder-neutral-400 focus:border-secondary-500 focus:bg-white focus:ring-1 focus:ring-secondary-500 transition-colors"
                                    placeholder="Telefon veya E-posta adresi">
                            </div>
                            @error('contact_info') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label for="details" class="text-sm font-medium text-primary-700">Arıza Detayı</label>
                            <textarea name="details" id="details" rows="5" required
                                class="block w-full rounded-lg border-neutral-light bg-neutral-bg/50 px-4 py-3 text-sm text-primary-900 placeholder-neutral-400 focus:border-secondary-500 focus:bg-white focus:ring-1 focus:ring-secondary-500 transition-colors resize-none"
                                placeholder="Lütfen yaşadığınız sorunu detaylıca anlatınız..."></textarea>
                            @error('details') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-primary-900 hover:bg-secondary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition-all shadow-md hover:shadow-lg">
                            {{ setting('btn_submit_request', 'Arıza Kaydı Oluştur') }}
                        </button>
                        <p class="mt-4 text-center text-xs text-neutral-400">
                            Gönderilen bilgiler gizlilik politikamız gereği korunmaktadır.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection