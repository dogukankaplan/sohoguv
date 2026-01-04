@extends('layouts.app')

@section('content')
    <div class="bg-white">
        {{-- Hero Section with Stats --}}
        <section class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-br from-slate-50 via-white to-slate-50">
            {{-- Background Pattern --}}
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px] pointer-events-none">
            </div>

            {{-- Animated Orbs --}}
            <div class="absolute top-20 right-[10%] w-96 h-96 bg-brand-400/10 rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-20 left-[15%] w-80 h-80 bg-accent-400/10 rounded-full blur-3xl animate-float"
                style="animation-delay: -2s;"></div>

            <div class="container-custom relative z-10">
                <div class="max-w-4xl mx-auto text-center space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Hakkımızda</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900">
                        <span
                            class="bg-gradient-to-r from-brand-600 via-accent-600 to-brand-700 bg-clip-text text-transparent">
                            Güvenlik ve Teknolojiyi
                        </span>
                        <span class="block mt-2">Birleştiriyoruz</span>
                    </h1>

                    <p class="text-lg sm:text-xl text-slate-600 leading-relaxed max-w-3xl mx-auto">
                        {{ setting('about_hero_desc', 'SOHO Güvenlik Sistemleri olarak, sektörde uzun yıllardır müşterilerimize en iyi hizmeti sunmanın gururunu yaşıyoruz.') }}
                    </p>

                    {{-- Stats --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pt-8">
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                            <div class="text-3xl font-bold text-brand-600 mb-2">15+</div>
                            <div class="text-sm text-slate-600">Yıllık Deneyim</div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                            <div class="text-3xl font-bold text-brand-600 mb-2">5K+</div>
                            <div class="text-sm text-slate-600">Mutlu Müşteri</div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                            <div class="text-3xl font-bold text-brand-600 mb-2">81</div>
                            <div class="text-sm text-slate-600">İlde Hizmet</div>
                        </div>
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 hover:border-brand-300 transition-all">
                            <div class="text-3xl font-bold text-brand-600 mb-2">%99</div>
                            <div class="text-sm text-slate-600">Memnuniyet</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Mission, Vision & Values - Modern Card Layout --}}
        <section class="py-20 bg-white">
            <div class="container-custom">
                <div class="grid lg:grid-cols-3 gap-8">
                    {{-- Mission --}}
                    <div
                        class="group relative bg-gradient-to-br from-brand-50 to-white rounded-3xl border border-brand-100 p-8 hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-400/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 rounded-2xl bg-brand-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ setting('mission_title', 'Misyonumuz') }}
                            </h3>
                            <p class="text-slate-600 leading-relaxed">
                                {{ setting('mission_desc', 'Kurumsal güvenlik ve teknoloji altyapılarını en yüksek standartlarda hizmet vererek güçlendirmek, müşterilerimizin iş sürekliliğini ve güvenliğini garanti altına almak.') }}
                            </p>
                        </div>
                    </div>

                    {{-- Vision --}}
                    <div
                        class="group relative bg-gradient-to-br from-accent-50 to-white rounded-3xl border border-accent-100 p-8 hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-accent-400/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 rounded-2xl bg-accent-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-accent-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ setting('vision_title', 'Vizyonumuz') }}
                            </h3>
                            <p class="text-slate-600 leading-relaxed">
                                {{ setting('vision_desc', "Türkiye'nin güvenlik ve teknoloji sektöründe lider firma olmak, innovative çözümlerimizle müşterilerimize katma değer yaratmaya devam etmek.") }}
                            </p>
                        </div>
                    </div>

                    {{-- Values --}}
                    <div
                        class="group relative bg-gradient-to-br from-amber-50 to-white rounded-3xl border border-amber-100 p-8 hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl"></div>
                        <div class="relative">
                            <div
                                class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ setting('values_title', 'Değerlerimiz') }}
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-slate-600">Güvenilirlik</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-slate-600">Kalite</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-sm text-slate-600">İnovasyon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Timeline Section --}}
        <section class="py-20 bg-gradient-to-b from-slate-50 to-white">
            <div class="container-custom">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                        <span class="bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">
                            Yolculuğumuz
                        </span>
                    </h2>
                    <p class="text-lg text-slate-600">Başarı hikayemizin kilometre taşları</p>
                </div>

                <div class="max-w-4xl mx-auto">
                    <div class="space-y-8">
                        {{-- Timeline Item 1 --}}
                        <div class="flex gap-6 group">
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="w-0.5 h-full bg-gradient-to-b from-brand-500 to-transparent"></div>
                            </div>
                            <div
                                class="bg-white rounded-2xl border border-slate-200 p-6 flex-1 group-hover:border-brand-300 group-hover:shadow-lg transition-all">
                                <div class="text-sm font-bold text-brand-600 mb-2">2009</div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Kuruluş</h3>
                                <p class="text-slate-600">SOHO Güvenlik Sistemleri kuruldu ve ilk müşteri ağımızı
                                    oluşturduk.</p>
                            </div>
                        </div>

                        {{-- Timeline Item 2 --}}
                        <div class="flex gap-6 group">
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-accent-500 to-brand-500 flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="w-0.5 h-full bg-gradient-to-b from-accent-500 to-transparent"></div>
                            </div>
                            <div
                                class="bg-white rounded-2xl border border-slate-200 p-6 flex-1 group-hover:border-accent-300 group-hover:shadow-lg transition-all">
                                <div class="text-sm font-bold text-accent-600 mb-2">2015</div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Türkiye Geneli Hizmet</h3>
                                <p class="text-slate-600">81 ilde hizmet veren kapsamlı ağımızı kurduk.</p>
                            </div>
                        </div>

                        {{-- Timeline Item 3 --}}
                        <div class="flex gap-6 group">
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-500 to-brand-500 flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="bg-white rounded-2xl border border-slate-200 p-6 flex-1 group-hover:border-amber-300 group-hover:shadow-lg transition-all">
                                <div class="text-sm font-bold text-amber-600 mb-2">2024</div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">Sektör Lideri</h3>
                                <p class="text-slate-600">5000+ mutlu müşteri ve %99 memnuniyet oranı ile sektörün öncü
                                    firmalarından biri olduk.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Team Section (if exists) --}}
        @if($teamMembers->count() > 0)
            <section class="py-20 bg-white">
                <div class="container-custom">
                    <div class="max-w-3xl mx-auto text-center mb-16">
                        <p class="text-sm font-bold text-brand-600 uppercase tracking-wider mb-4">Ekibimiz</p>
                        <h2 class="text-3xl sm:text-4xl font-bold text-slate-900">
                            <span class="bg-gradient-to-r from-brand-600 to-accent-600 bg-clip-text text-transparent">
                                Uzman
                            </span> Kadromuz
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($teamMembers as $member)
                            <div
                                class="bg-white rounded-2xl border border-slate-200 p-6 text-center hover:border-brand-300 hover:shadow-xl transition-all group">
                                @if($member->photo)
                                    <div
                                        class="w-24 h-24 rounded-full mx-auto mb-4 overflow-hidden ring-4 ring-brand-50 group-hover:ring-brand-100 transition-all">
                                        <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-24 h-24 rounded-full bg-gradient-to-br from-brand-100 to-accent-100 mx-auto mb-4 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $member->name }}</h3>
                                <p class="text-brand-600 text-sm font-semibold mb-3">{{ $member->role }}</p>
                                @if($member->bio)
                                    <p class="text-sm text-slate-600 leading-relaxed">{{ $member->bio }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- CTA Section --}}
        <section class="py-20 bg-gradient-to-br from-brand-600 via-brand-700 to-accent-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="container-custom relative z-10 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                    Güvenlik Altyapınızı Bizimle Güçlendirin
                </h2>
                <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    Profesyonel ekibimiz ve kanıtlanmış çözümlerimizle tanışın
                </p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-brand-700 font-semibold hover:bg-slate-50 transition-all shadow-lg hover:shadow-xl">
                    <span>Ücretsiz Danışmanlık Alın</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </section>
    </div>
@endsection