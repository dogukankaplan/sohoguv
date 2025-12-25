@extends('layouts.app')

@section('content')
    <div class="relative bg-slate-900 text-white">
        <!-- Hero -->
        <div class="relative pt-32 pb-20">
            <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-black tracking-tight sm:text-6xl mb-6">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-soho-teal to-soho-purple">Güvenlik</span>
                    ve <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-soho-purple to-soho-teal">Teknolojiyi</span><br>
                    Birleştiriyoruz
                </h1>
                <p class="mt-6 text-lg leading-8 text-slate-400 max-w-2xl mx-auto">
                    SOHO Güvenlik Sistemleri olarak, sektörde 15 yıldır müşterilerimize en iyi hizmeti sunmanın gururunu
                    yaşıyoruz.
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="py-24 bg-slate-950">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                        <div class="w-16 h-16 rounded-2xl bg-soho-teal/20 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-soho-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Misyonumuz</h2>
                        <p class="text-slate-400 leading-relaxed">
                            Kurumsal güvenlik ve teknoloji altyapılarını en yüksek standartlarda hizmet vererek
                            güçlendirmek, müşterilerimizin iş sürekliliğini ve güvenliğini garanti altına almak.
                        </p>
                    </div>

                    <div class="bg-slate-800/50 rounded-3xl p-10 border border-slate-700">
                        <div class="w-16 h-16 rounded-2xl bg-soho-purple/20 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-soho-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold mb-4">Vizyonumuz</h2>
                        <p class="text-slate-400 leading-relaxed">
                            Türkiye'nin güvenlik ve teknoloji sektöründe lider firma olmak, innovative çözümlerimizle
                            müşterilerimize katma değer yaratmaya devam etmek.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        @if($teamMembers->count() > 0)
            <div class="py-24 bg-slate-900">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center mb-16">
                        <h2 class="text-base font-bold text-soho-teal tracking-widest uppercase">Ekibimiz</h2>
                        <p class="mt-4 text-4xl font-bold tracking-tight text-white">Uzman Kadromuz</p>
                    </div>

                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($teamMembers as $member)
                            <div
                                class="group relative bg-slate-800/50 rounded-3xl p-8 border border-slate-700 hover:border-soho-teal transition-all duration-300">
                                @if($member->photo)
                                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}"
                                        class="w-24 h-24 rounded-2xl object-cover mb-6 ring-4 ring-slate-700 group-hover:ring-soho-teal transition-all">
                                @else
                                    <div class="w-24 h-24 rounded-2xl bg-slate-700 mb-6 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-xl font-bold text-white mb-2">{{ $member->name }}</h3>
                                <p class="text-soho-teal text-sm font-semibold mb-4">{{ $member->role }}</p>
                                @if($member->bio)
                                    <p class="text-slate-400 text-sm leading-relaxed">{{ $member->bio }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Values -->
        <div class="py-24 bg-slate-950">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center mb-16">
                    <h2 class="text-4xl font-bold tracking-tight text-white">Değerlerimiz</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-soho-teal/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-soho-teal">01</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Güvenilirlik</h3>
                        <p class="text-slate-400">Müşteri memnuniyeti odaklı, şeffaf ve dürüst iş anlayışı</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-soho-purple/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-soho-purple">02</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Kalite</h3>
                        <p class="text-slate-400">En son teknolojiler ve uluslararası standartlar</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-soho-teal/20 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-soho-teal">03</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">İnovasyon</h3>
                        <p class="text-slate-400">Sürekli gelişim ve yenilikçi çözümler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection