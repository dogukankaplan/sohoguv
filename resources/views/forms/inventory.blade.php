@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen relative flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-950 overflow-hidden">
        {{-- Immersive Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 inset-x-0 h-[500px] bg-gradient-to-b from-orange-600/20 to-transparent opacity-60">
            </div>
            <div class="absolute -top-[20%] -left-[10%] w-[800px] h-[800px] bg-orange-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[600px] h-[600px] bg-amber-500/5 rounded-full blur-3xl"></div>
            <!-- Grid Pattern -->
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150 mix-blend-overlay">
            </div>
        </div>

        {{-- Main Card --}}
        <div
            class="relative w-full max-w-2xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden ring-1 ring-white/10 backdrop-blur-sm">

            {{-- Header Section --}}
            <div class="relative bg-slate-50 border-b border-slate-100 p-10 text-center overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-orange-500 via-amber-500 to-orange-500">
                </div>

                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white shadow-lg shadow-orange-500/10 mb-6 ring-1 ring-slate-100">
                    <svg class="w-8 h-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-slate-900 tracking-tight mb-3">
                    {{ setting('inventory_form_title', 'Envanter Talebi') }}
                </h2>
                <p class="text-lg text-slate-500 max-w-md mx-auto leading-relaxed">
                    {{ setting('inventory_form_desc', 'Donanım ve ekipman ihtiyaçlarınızı buradan hızlıca bize iletebilirsiniz.') }}
                </p>
            </div>

            {{-- Form Section --}}
            <div class="p-8 md:p-12 relative z-10">
                @if(session('success'))
                    <div
                        class="mb-10 p-4 rounded-xl bg-orange-50 border border-orange-100 flex items-center gap-4 animate-fade-in shadow-sm">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-orange-800">Talebiniz Alındı</h4>
                            <p class="text-orange-600 text-sm mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <input type="hidden" name="type" value="inventory">

                    <div class="space-y-6">
                        {{-- Input Group 1 --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Ad Soyad /
                                Departman</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-orange-500 transition-colors duration-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" required
                                    class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl pl-12 pr-4 py-4 text-base focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 outline-none shadow-sm group-hover:bg-slate-50/80"
                                    placeholder="Örn: İnsan Kaynakları - Ayşe Demir">
                            </div>
                            @error('name') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Group 2 --}}
                        <div>
                            <label for="contact_info" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">İletişim
                                (Dahili / Email)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-orange-500 transition-colors duration-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="text" name="contact_info" id="contact_info" required
                                    class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl pl-12 pr-4 py-4 text-base focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 outline-none shadow-sm group-hover:bg-slate-50/80"
                                    placeholder="Dahili: 105 veya email@sirket.com">
                            </div>
                            @error('contact_info') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Textarea --}}
                        <div>
                            <label for="details" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Talep
                                Detayları</label>
                            <textarea name="details" id="details" rows="5" required
                                class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl px-5 py-4 text-base focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 outline-none shadow-sm resize-none group-hover:bg-slate-50/80"
                                placeholder="İhtiyaç duyulan malzeme veya ekipmanı belirtiniz..."></textarea>
                            @error('details') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full group relative flex justify-center py-4 px-4 border border-transparent text-lg font-bold rounded-xl text-white bg-slate-900 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-300 shadow-xl overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                Talep Oluştur
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                            <div
                                class="absolute inset-0 h-full w-full bg-orange-600 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500 ease-out">
                            </div>
                        </button>

                        <p class="mt-6 text-center text-xs text-slate-400 flex items-center justify-center gap-2">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Onay süreci için yöneticinize bilgilendirme gönderilecektir.
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer Decor --}}
            <div class="h-2 bg-gradient-to-r from-orange-500 via-amber-500 to-orange-500 opacity-50"></div>
        </div>
    </div>
@endsection