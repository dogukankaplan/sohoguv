@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen relative flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 bg-slate-900 overflow-hidden">
        {{-- Immersive Background --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 inset-x-0 h-[500px] bg-gradient-to-b from-blue-600/20 to-transparent opacity-60">
            </div>
            <div class="absolute -top-[20%] -right-[10%] w-[800px] h-[800px] bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[600px] h-[600px] bg-purple-500/10 rounded-full blur-3xl">
            </div>
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
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500"></div>

                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white shadow-lg shadow-blue-500/10 mb-6 ring-1 ring-slate-100">
                    <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-slate-900 tracking-tight mb-3">
                    {{ setting('fault_form_title', 'Arıza Bildirimi') }}
                </h2>
                <p class="text-lg text-slate-500 max-w-md mx-auto leading-relaxed">
                    {{ setting('fault_form_desc', 'Teknik sorunlarınızı en hızlı şekilde çözebilmemiz için aşağıdaki formu eksiksiz doldurunuz.') }}
                </p>
            </div>

            {{-- Form Section --}}
            <div class="p-8 md:p-12 relative z-10">
                @if(session('success'))
                    <div
                        class="mb-10 p-4 rounded-xl bg-green-50 border border-green-100 flex items-center gap-4 animate-fade-in shadow-sm">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-800">Talebiniz Alındı</h4>
                            <p class="text-green-600 text-sm mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <input type="hidden" name="type" value="fault">

                    <div class="space-y-6">
                        {{-- Input Group 1 --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Ad Soyad /
                                Firma</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" required
                                    class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl pl-12 pr-4 py-4 text-base focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 outline-none shadow-sm group-hover:bg-slate-50/80"
                                    placeholder="Örn: Ahmet Yılmaz">
                            </div>
                            @error('name') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Group 2 --}}
                        <div>
                            <label for="contact_info" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">İletişim
                                Bilgileri</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input type="text" name="contact_info" id="contact_info" required
                                    class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl pl-12 pr-4 py-4 text-base focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 outline-none shadow-sm group-hover:bg-slate-50/80"
                                    placeholder="Telefon">
                            </div>
                            @error('contact_info') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Textarea --}}
                        <div>
                            <label for="details" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Arıza
                                Detayı</label>
                            <textarea name="details" id="details" rows="5" required
                                class="w-full bg-slate-50 text-slate-900 placeholder-slate-400 border border-slate-200 rounded-xl px-5 py-4 text-base focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 outline-none shadow-sm resize-none group-hover:bg-slate-50/80"
                                placeholder="Yaşadığınız sorunu buraya yazın..."></textarea>
                            @error('details') <p class="mt-2 text-sm text-red-500 font-medium ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full group relative flex justify-center py-4 px-4 border border-transparent text-lg font-bold rounded-xl text-white bg-slate-900 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all duration-300 shadow-xl overflow-hidden">
                            <span class="relative z-10 flex items-center gap-2">
                                {{ setting('btn_submit_request', 'Destek Talebi Oluştur') }}
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>
                            <div
                                class="absolute inset-0 h-full w-full bg-blue-600 scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500 ease-out">
                            </div>
                        </button>

                        <p class="mt-6 text-center text-xs text-slate-400 flex items-center justify-center gap-2">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Bilgileriniz 256-bit SSL şifreleme ile güvendedir.
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer Decor --}}
            <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 opacity-50"></div>
        </div>
    </div>
@endsection