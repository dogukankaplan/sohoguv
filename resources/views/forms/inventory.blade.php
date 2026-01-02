@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen py-20">
        {{-- Decorative Background --}}
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-0 left-0 w-96 h-96 bg-amber-100 rounded-full opacity-30 blur-3xl -translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-orange-100 rounded-full opacity-30 blur-3xl translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <div class="container-custom relative z-10">
            <div class="max-w-2xl mx-auto text-center mb-12 animate-fade-in">
                <h1 class="heading-md mb-4">Envanter Talep Formu</h1>
                <p class="text-body">Donanım ve yazılım ihtiyaçlarınızı bize iletin.</p>
            </div>

            <div class="max-w-xl mx-auto">
                <div class="card-modern relative overflow-hidden animate-slide-up">
                    {{-- Top Gradient Border --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-orange-500"></div>

                    @if(session('success'))
                        <div class="mb-8 p-4 rounded-2xl bg-green-50 border border-green-200 flex items-center gap-3">
                            <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm font-semibold text-green-700">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('requests.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="type" value="inventory">

                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Ad Soyad / Firma</label>
                            <input type="text" name="name" id="name" required
                                class="input-pill focus:border-amber-400 focus:ring-amber-200"
                                placeholder="Örn: İnsan Kaynakları">
                            @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="contact_info" class="block text-sm font-bold text-gray-900 mb-2">İletişim
                                Bilgileri</label>
                            <input type="text" name="contact_info" id="contact_info" required
                                class="input-pill focus:border-amber-400 focus:ring-amber-200"
                                placeholder="Dahili numara veya e-posta">
                            @error('contact_info') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="details" class="block text-sm font-bold text-gray-900 mb-2">Talep Detayı</label>
                            <textarea name="details" id="details" rows="5" required
                                class="textarea-modern focus:border-amber-400 focus:ring-amber-200"
                                placeholder="İhtiyaç duyulan malzeme veya yazılımı belirtiniz..."></textarea>
                            @error('details') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 to-orange-500 text-white font-semibold text-lg hover:scale-105 transform transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center justify-center gap-2">
                            Talebi Gönder
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </button>

                        <p class="text-center text-xs text-gray-400 mt-4">Envanter talepleri yönetici onayı gerektirebilir.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection