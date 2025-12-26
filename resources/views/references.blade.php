@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg">
        {{-- Hero --}}
        <section class="relative pt-32 pb-20 bg-white">
            <div class="container-custom text-center">
                <h1 class="heading-xl mb-6">
                    {!! setting('references_hero_title', '<span class="gradient-text">Referanslarımız</span>') !!}
                </h1>
                <p class="text-body max-w-2xl mx-auto">
                    {{ setting('references_hero_desc', "Türkiye'nin önde gelen kurumlarına hizmet vermenin gururunu yaşıyoruz.") }}
                </p>
            </div>
        </section>

        {{-- Clients --}}
        @if($clients->count() > 0)
            <section class="section-padding bg-neutral-bg">
                <div class="container-custom">
                    <h2 class="heading-md text-center mb-12">{{ setting('clients_title', 'Güvenilir İş Ortaklarımız') }}</h2>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($clients as $client)
                            <div class="card p-8 flex items-center justify-center hover-lift">
                                @if($client->logo)
                                    <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-w-full h-16 object-contain opacity-60 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                                @else
                                    <span class="text-neutral-medium hover:text-primary-500 transition-colors font-semibold">{{ $client->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Testimonials --}}
        @if($testimonials->count() > 0)
            <section class="section-padding bg-white">
                <div class="container-custom">
                    <div class="max-w-2xl mx-auto text-center mb-16">
                        <h2 class="text-sm font-bold text-secondary-500 uppercase tracking-wider mb-3">
                            {{ setting('testimonials_subtitle', 'Müşteri Yorumları') }}
                        </h2>
                        <h3 class="heading-lg">
                            {{ setting('testimonials_title', 'Size En İyisini Sunuyoruz') }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($testimonials as $testimonial)
                            <div class="card p-8 flex flex-col">
                                <div class="flex items-center gap-1 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-neutral-light" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>

                                <p class="text-neutral-medium leading-relaxed mb-6 flex-grow">
                                    "{{ $testimonial->content }}"
                                </p>

                                <div class="flex items-center gap-4 mt-auto pt-6 border-t border-neutral-light">
                                    @if($testimonial->photo)
                                        <img src="{{ Storage::url($testimonial->photo) }}" alt="{{ $testimonial->name }}"
                                            class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                            <span class="text-lg font-bold text-secondary-500">{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div>
                                        <p class="font-semibold text-primary-500">{{ $testimonial->name }}</p>
                                        @if($testimonial->role || $testimonial->company)
                                            <p class="text-sm text-neutral-medium">
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
            </section>
        @endif

        @if($clients->count() === 0 && $testimonials->count() === 0)
            <section class="section-padding">
                <div class="container-custom">
                    <div class="max-w-2xl mx-auto text-center">
                        <p class="text-neutral-medium">{{ setting('msg_no_clients', 'Referanslar yakında eklenecek.') }}</p>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection