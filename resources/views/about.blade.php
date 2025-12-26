@extends('layouts.app')

@section('content')
    <div class="bg-neutral-bg">
        {{-- Hero --}}
        <section class="relative pt-32 pb-20 bg-white">
            <div class="container-custom text-center">
                <h1 class="heading-xl mb-6">
                    {!! setting('about_hero_title', '<span class="gradient-text">Güvenlik</span> ve <span class="gradient-text">Teknolojiyi</span> Birleştiriyoruz') !!}
                </h1>
                <p class="text-body max-w-2xl mx-auto">
                    {{ setting('about_hero_desc', 'SOHO Güvenlik Sistemleri olarak, sektörde 15 yıldır müşterilerimize en iyi hizmeti sunmanın gururunu yaşıyoruz.') }}
                </p>
            </div>
        </section>

        {{-- Mission & Vision --}}
        <section class="section-padding bg-neutral-bg">
            <div class="container-custom">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="card p-10">
                        <div class="w-16 h-16 rounded-lg bg-secondary-50 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-primary-500 mb-4">{{ setting('mission_title', 'Misyonumuz') }}
                        </h2>
                        <p class="text-neutral-medium leading-relaxed">
                            {{ setting('mission_desc', 'Kurumsal güvenlik ve teknoloji altyapılarını en yüksek standartlarda hizmet vererek güçlendirmek, müşterilerimizin iş sürekliliğini ve güvenliğini garanti altına almak.') }}
                        </p>
                    </div>

                    <div class="card p-10">
                        <div class="w-16 h-16 rounded-lg bg-accent-50 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-primary-500 mb-4">{{ setting('vision_title', 'Vizyonumuz') }}
                        </h2>
                        <p class="text-neutral-medium leading-relaxed">
                            {{ setting('vision_desc', "Türkiye'nin güvenlik ve teknoloji sektöründe lider firma olmak, innovative çözümlerimizle müşterilerimize katma değer yaratmaya devam etmek.") }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Team Section --}}
        @if($teamMembers->count() > 0)
            <section class="section-padding bg-white">
                <div class="container-custom">
                    <div class="max-w-2xl mx-auto text-center mb-16">
                        <h2 class="text-sm font-bold text-secondary-500 uppercase tracking-wider mb-3">
                            {{ setting('team_subtitle', 'Ekibimiz') }}
                        </h2>
                        <h3 class="heading-lg">
                            {{ setting('team_title', 'Uzman Kadromuz') }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($teamMembers as $member)
                            <div class="card p-8 text-center hover-lift">
                                @if($member->photo)
                                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                                        class="w-24 h-24 rounded-full object-cover mx-auto mb-6">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-secondary-50 mx-auto mb-6 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-xl font-bold text-primary-500 mb-2">{{ $member->name }}</h3>
                                <p class="text-secondary-500 text-sm font-semibold mb-4">{{ $member->role }}</p>
                                @if($member->bio)
                                    <p class="text-neutral-medium text-sm leading-relaxed">{{ $member->bio }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Values --}}
        <section class="section-padding bg-neutral-bg">
            <div class="container-custom">
                <div class="max-w-2xl mx-auto text-center mb-16">
                    <h2 class="heading-lg">{{ setting('values_title', 'Değerlerimiz') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-secondary-50 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-secondary-500">01</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-500 mb-3">{{ setting('value_1_title', 'Güvenilirlik') }}
                        </h3>
                        <p class="text-neutral-medium">
                            {{ setting('value_1_desc', 'Müşteri memnuniyeti odaklı, şeffaf ve dürüst iş anlayışı') }}
                        </p>
                    </div>

                    <div class="card p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-accent-50 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-accent-500">02</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-500 mb-3">{{ setting('value_2_title', 'Kalite') }}</h3>
                        <p class="text-neutral-medium">
                            {{ setting('value_2_desc', 'En son teknolojiler ve uluslararası standartlar') }}
                        </p>
                    </div>

                    <div class="card p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-secondary-50 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-secondary-500">03</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-500 mb-3">{{ setting('value_3_title', 'İnovasyon') }}</h3>
                        <p class="text-neutral-medium">
                            {{ setting('value_3_desc', 'Sürekli gelişim ve yenilikçi çözümler') }}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection