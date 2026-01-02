@extends('layouts.app')

@section('content')
    <div class="bg-white">
        {{-- Hero --}}
        <section class="section-padding-sm bg-gradient-subtle">
            <div class="container-custom text-center max-w-4xl mx-auto space-y-6 animate-fade-in">
                <p class="text-sm font-bold text-cyan-600 uppercase tracking-wider">Hakkımızda</p>
                <h1 class="heading-xl">
                    <span class="text-gradient">Güvenlik ve Teknolojiyi</span>
                    <span class="block mt-2">Birleştiriyoruz</span>
                </h1>
                <p class="text-body-lg">
                    {{ setting('about_hero_desc', 'SOHO Güvenlik Sistemleri olarak, sektörde uzun yıllardır müşterilerimize en iyi hizmeti sunmanın gururunu yaşıyoruz.') }}
                </p>
            </div>
        </section>

        {{-- Mission & Vision --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="card-gradient-border">
                        <div class="icon-circle-gradient mb-6">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h2 class="heading-md mb-4">{{ setting('mission_title', 'Misyonumuz') }}</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ setting('mission_desc', 'Kurumsal güvenlik ve teknoloji altyapılarını en yüksek standartlarda hizmet vererek güçlendirmek, müşterilemizin iş sürekliliğini ve güvenliğini garanti altına almak.') }}
                        </p>
                    </div>

                    <div class="card-gradient-border">
                        <div class="icon-circle-gradient mb-6">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h2 class="heading-md mb-4">{{ setting('vision_title', 'Vizyonumuz') }}</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ setting('vision_desc', "Türkiye'nin güvenlik ve teknoloji sektöründe lider firma olmak, innovative çözümlerimizle müşterilerimize katma değer yaratmaya devam etmek.") }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Team Section --}}
        @if($teamMembers->count() > 0)
            <section class="section-padding bg-gray-50">
                <div class="container-custom">
                    <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                        <p class="text-sm font-bold text-magenta-600 uppercase tracking-wider">
                            {{ setting('team_subtitle', 'Ekibimiz') }}</p>
                        <h2 class="heading-xl">
                            <span class="text-gradient">Uzman</span> Kadromuz
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($teamMembers as $member)
                            <div class="card-modern text-center hover-lift">
                                @if($member->photo)
                                    <div class="img-ellipse w-32 h-32 mx-auto mb-6 ring-4 ring-cyan-100">
                                        <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="icon-circle w-32 h-32 mx-auto mb-6">
                                        <svg class="w-16 h-16 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="heading-sm mb-2">{{ $member->name }}</h3>
                                <p class="text-cyan-600 text-sm font-semibold mb-4">{{ $member->role }}</p>
                                @if($member->bio)
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $member->bio }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Values --}}
        <section class="section-padding bg-white">
            <div class="container-custom">
                <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
                    <h2 class="heading-xl">{{ setting('values_title', 'Değerlerimiz') }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="card-modern text-center">
                        <div class="icon-circle mx-auto mb-6">
                            <span class="text-3xl font-bold text-gradient">01</span>
                        </div>
                        <h3 class="heading-sm mb-3">{{ setting('value_1_title', 'Güvenilirlik') }}</h3>
                        <p class="text-gray-600">
                            {{ setting('value_1_desc', 'Müşteri memnuniyeti odaklı, şeffaf ve dürüst iş anlayışı') }}
                        </p>
                    </div>

                    <div class="card-modern text-center">
                        <div class="icon-circle mx-auto mb-6">
                            <span class="text-3xl font-bold text-gradient">02</span>
                        </div>
                        <h3 class="heading-sm mb-3">{{ setting('value_2_title', 'Kalite') }}</h3>
                        <p class="text-gray-600">
                            {{ setting('value_2_desc', 'En son teknolojiler ve uluslararası standartlar') }}
                        </p>
                    </div>

                    <div class="card-modern text-center">
                        <div class="icon-circle mx-auto mb-6">
                            <span class="text-3xl font-bold text-gradient">03</span>
                        </div>
                        <h3 class="heading-sm mb-3">{{ setting('value_3_title', 'İnovasyon') }}</h3>
                        <p class="text-gray-600">
                            {{ setting('value_3_desc', 'Sürekli gelişim ve yenilikçi çözümler') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection