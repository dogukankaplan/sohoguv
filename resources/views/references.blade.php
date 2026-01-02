@extends('layouts.app')

@section('content')
    <div class="bg-white min-h-screen">
        {{-- Hero --}}
        <section class="section-padding-sm bg-gradient-subtle">
            <div class="container-custom text-center max-w-4xl mx-auto space-y-6 animate-fade-in">
                <p class="text-sm font-bold text-cyan-600 uppercase tracking-wider">Referanslar</p>
                <h1 class="heading-xl">
                    Bize <span class="text-gradient">Güvenen</span> Markalar
                </h1>
                <p class="text-body-lg">
                    Türkiye'nin önde gelen kurum ve kuruluşlarına güvenlik çözümleri sunmaktan gurur duyuyoruz.
                </p>
            </div>
        </section>

        {{-- Clients Grid --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                @if($clients->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 align-middle items-center">
                        @foreach($clients as $client)
                            <div
                                class="group flex items-center justify-center p-8 rounded-4xl bg-gray-50 hover:bg-white hover:shadow-strong transition-all duration-300 border border-transparent hover:border-cyan-100">
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-h-20 w-auto grayscale group-hover:grayscale-0 opacity-70 group-hover:opacity-100 transition duration-300 transform group-hover:scale-110">
                                @else
                                    <span
                                        class="text-lg font-bold text-gray-500 group-hover:text-cyan-600 transition">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20">
                        <p class="text-gray-500 text-lg">Henüz referans eklenmemiş.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- Testimonials --}}
        @if(isset($testimonials) && $testimonials->count() > 0)
            <section class="section-padding bg-gray-50">
                <div class="container-custom">
                    <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                        <h2 class="heading-xl">Müşteri <span class="text-gradient">Yorumları</span></h2>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                            <div class="card-modern">
                                <div class="flex items-center gap-1 text-orange-400 mb-6">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                <p class="text-gray-600 italic mb-6 leading-relaxed">"{{ $testimonial->content }}"</p>

                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-cyan-100 flex items-center justify-center font-bold text-cyan-700 text-lg">
                                        {{ substr($testimonial->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $testimonial->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $testimonial->company ?? 'Müşteri' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- CTA --}}
        <section class="py-20 bg-white">
            <div class="container-custom">
                <div class="bg-gradient-primary rounded-4xl p-12 text-center relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIi8+PC9zdmc+')] opacity-20">
                    </div>

                    <div class="relative z-10 max-w-2xl mx-auto space-y-8">
                        <h2 class="heading-lg text-white">Siz de Mutlu Müşterilerimiz Arasına Katılın</h2>
                        <a href="{{ route('contact') }}" class="btn-white">
                            Hemen Başlayın
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection