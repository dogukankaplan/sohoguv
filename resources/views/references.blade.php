@extends('layouts.app')

@section('content')
    <div class="relative bg-slate-900 text-white">
        <!-- Hero -->
        <div class="relative pt-32 pb-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-black tracking-tight sm:text-6xl mb-6">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-soho-teal to-soho-purple">Referanslarımız</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-slate-400 max-w-2xl mx-auto">
                    Türkiye'nin önde gelen kurumlarına hizmet vermenin gururunu yaşıyoruz.
                </p>
            </div>
        </div>

        <!-- Clients -->
        @if($clients->count() > 0)
            <div class="py-24 bg-slate-950">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center mb-16">Güvenilir İş Ortaklarımız</h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach($clients as $client)
                            <div
                                class="group bg-slate-800/30 rounded-2xl p-6 border border-slate-700 hover:border-soho-teal transition-all duration-300 flex items-center justify-center">
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-w-full h-20 object-contain opacity-60 group-hover:opacity-100 transition-opacity grayscale group-hover:grayscale-0">
                                @else
                                    <span
                                        class="text-slate-500 group-hover:text-white transition-colors font-semibold">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Testimonials -->
        @if($testimonials->count() > 0)
            <div class="py-24 bg-slate-900">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center mb-16">
                        <h2 class="text-base font-bold text-soho-teal tracking-widest uppercase">Müşteri Yorumları</h2>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">Size En İyisini Sunuyoruz</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                            <div class="bg-slate-800/50 rounded-3xl p-8 border border-slate-700 flex flex-col">
                                <div class="flex items-center gap-1 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-slate-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>

                                <p class="text-slate-300 leading-relaxed mb-6 flex-grow">
                                    "{{ $testimonial->content }}"
                                </p>

                                <div class="flex items-center gap-4 mt-auto pt-6 border-t border-slate-700">
                                    @if($testimonial->photo)
                                        <img src="{{ Storage::url($testimonial->photo) }}" alt="{{ $testimonial->name }}"
                                            class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-slate-700 flex items-center justify-center">
                                            <span class="text-lg font-bold text-slate-400">{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-white">{{ $testimonial->name }}</p>
                                        @if($testimonial->role || $testimonial->company)
                                            <p class="text-sm text-slate-400">
                                                @if($testimonial->role){{ $testimonial->role }}@endif
                                                @if($testimonial->role && $testimonial->company), @endif
                                                @if($testimonial->company){{ $testimonial->company }}@endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($clients->count() === 0 && $testimonials->count() === 0)
            <div class="py-24">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-slate-500">Referanslar yakında eklenecek.</p>
                </div>
            </div>
        @endif
    </div>
@endsection