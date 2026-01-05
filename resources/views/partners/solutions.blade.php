@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-br from-slate-50 via-white to-slate-50 py-20 overflow-hidden">
        <div class="container-custom relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    <span class="bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">Çözüm
                        Ortaklarımız</span>
                </h1>
                <p class="text-xl text-slate-600">
                    Teknoloji ve çözüm ortağımız global markalar
                </p>
            </div>
        </div>
    </div>

    {{-- Solution Partners Grid --}}
    <section class="section-padding bg-white">
        <div class="container-custom">
            @if($solutionPartners->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($solutionPartners as $sp)
                        <div
                            class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 hover:shadow-xl transition-all duration-300">
                            <div class="aspect-square flex items-center justify-center">
                                <img src="{{ Storage::url($sp->logo) }}" alt="{{ $sp->name }}"
                                    class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition duration-300">
                            </div>
                            <h3 class="text-center mt-4 font-semibold text-slate-900">{{ $sp->name }}</h3>
                            @if($sp->website && $sp->website !== '#')
                                <a href="{{ $sp->website }}" target="_blank"
                                    class="block text-center mt-2 text-sm text-brand-600 hover:text-brand-700">
                                    Website →
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-slate-400">Henüz çözüm ortağı eklenmemiş.</p>
                </div>
            @endif
        </div>
    </section>

@endsection