@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8 flex items-center justify-center relative overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-amber-500 to-transparent -z-10"></div>
        <div class="absolute -top-24 right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>

        <div class="max-w-xl w-full">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Envanter Talep Formu</h2>
                <p class="text-amber-100">Donanım ve yazılım ihtiyaçlarınızı buradan iletin.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden ring-1 ring-slate-900/5">
                @if(session('success'))
                    <div class="bg-green-50 px-6 py-4 flex items-center gap-3 border-b border-green-100">
                        <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('requests.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="inventory">

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Ad Soyad /
                                Departman</label>
                            <input type="text" name="name" id="name" required
                                class="block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                placeholder="Örn: Pazarlama Departmanı">
                            @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="contact_info" class="block text-sm font-semibold text-slate-700 mb-1">İletişim
                                Bilgileri</label>
                            <input type="text" name="contact_info" id="contact_info" required
                                class="block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                placeholder="Dahili numara veya e-posta">
                            @error('contact_info') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="details" class="block text-sm font-semibold text-slate-700 mb-1">Talep
                                Detayı</label>
                            <textarea name="details" id="details" rows="5" required
                                class="block w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder-slate-400 focus:border-amber-500 focus:bg-white focus:ring-2 focus:ring-amber-200 transition-all duration-200"
                                placeholder="İhtiyaç duyulan malzeme veya yazılımı belirtiniz..."></textarea>
                            @error('details') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-amber-500 px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/30 hover:bg-amber-600 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                            <span>Talebi İlet</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </button>
                        <p class="mt-4 text-center text-xs text-slate-400">
                            Envanter talepleri yönetici onayı gerektirebilir.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection