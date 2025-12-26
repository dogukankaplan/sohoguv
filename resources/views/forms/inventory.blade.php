@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-neutral-bg relative overflow-hidden flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
        {{-- Decorative Background Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[70vh] h-[70vh] rounded-full bg-accent-500/5 blur-3xl animate-pulse"
                style="animation-duration: 5s;"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[70vh] h-[70vh] rounded-full bg-secondary-500/5 blur-3xl animate-pulse"
                style="animation-duration: 7s; animation-delay: 1s;"></div>
            <div class="absolute inset-0 opacity-[0.02]"
                style="background-image: radial-gradient(#0A1628 1px, transparent 1px); background-size: 30px 30px;"></div>
        </div>

        <div
            class="relative w-full max-w-5xl bg-white rounded-3xl shadow-strong overflow-hidden flex flex-col md:flex-row-reverse animate-fade-in">
            {{-- Right: Visual Side --}}
            <div
                class="md:w-2/5 bg-gradient-to-bl from-accent-600 via-accent-500 to-accent-600 p-10 flex flex-col justify-between text-white relative overflow-hidden">
                <div class="absolute bottom-0 left-0 p-4 opacity-10">
                    <svg class="w-64 h-64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="font-bold tracking-wider uppercase text-sm text-white/80">Envanter</span>
                    </div>

                    <h2 class="text-3xl font-bold mb-4">Envanter & Donanım Talebi</h2>
                    <p class="text-white/90 leading-relaxed mb-8">
                        Yeni donanım, yazılım veya ofis ekipmanı ihtiyaçlarınızı buradan iletebilirsiniz. Talebiniz yönetici
                        onayına sunulacaktır.
                    </p>

                    <ul class="space-y-4 text-sm text-white/80">
                        <li class="flex items-center gap-3">
                            <div class="w-1 h-1 bg-white rounded-full"></div>
                            Hızlı Onay Süreci
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-1 h-1 bg-white rounded-full"></div>
                            Stok Kontrolü
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-1 h-1 bg-white rounded-full"></div>
                            Tedarik Takibi
                        </li>
                    </ul>
                </div>

                <div class="relative z-10 mt-12">
                    <div class="p-4 bg-white/10 rounded-xl border border-white/20 backdrop-blur-md">
                        <p class="text-xs font-medium text-white/90 italic">
                            "En verimli çalışma ortamı için ihtiyaç duyduğunuz her şey bir tık uzağınızda."
                        </p>
                    </div>
                </div>
            </div>

            {{-- Left: Form Side --}}
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
                            <h4 class="text-sm font-bold text-green-800">Talebiniz Alındı!</h4>
                            <p class="text-xs text-green-600">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="inventory">

                    <div class="space-y-5">
                        <div class="group">
                            <label for="name" class="block text-sm font-bold text-primary-700 mb-1 ml-1">Ad Soyad /
                                Departman</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400 group-focus-within:text-accent-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg pl-10 pr-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-accent-500 focus:bg-white focus:ring-0 transition-all duration-200"
                                    placeholder="Örn: İnsan Kaynakları">
                            </div>
                            @error('name') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="contact_info" class="block text-sm font-bold text-primary-700 mb-1 ml-1">İletişim
                                Bilgileri</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-neutral-400 group-focus-within:text-accent-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="contact_info" id="contact_info" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg pl-10 pr-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-accent-500 focus:bg-white focus:ring-0 transition-all duration-200"
                                    placeholder="Dahili numara veya e-posta">
                            </div>
                            @error('contact_info') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="details" class="block text-sm font-bold text-primary-700 mb-1 ml-1">Talep
                                Detayı</label>
                            <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                                <textarea name="details" id="details" rows="4" required
                                    class="block w-full rounded-xl border-neutral-light bg-neutral-bg px-4 py-3 text-primary-900 placeholder-neutral-medium focus:border-accent-500 focus:bg-white focus:ring-0 transition-all duration-200 resize-none"
                                    placeholder="İhtiyaç duyulan malzeme veya yazılımı belirtiniz..."></textarea>
                            </div>
                            @error('details') <p class="text-red-500 text-xs mt-1 ml-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full btn-accent py-4 text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Talebi Oluştur</span>
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                        <p class="mt-4 text-center text-xs text-neutral-400">
                            Envanter talepleri yönetici onayı gerektirir.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection