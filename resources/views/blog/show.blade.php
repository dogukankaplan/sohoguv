@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-32 pb-20">
        <div class="container-custom">

            {{-- Breadcrumb --}}
            <nav class="flex mb-8 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-brand-600 transition">Anasayfa</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-brand-600 transition">Haberler</a>
                <span class="mx-2">/</span>
                <span class="text-slate-900 font-medium truncate max-w-[200px]">{{ $post->title }}</span>
            </nav>

            <div class="grid lg:grid-cols-3 gap-12">

                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100">
                        {{-- Featured Image --}}
                        <div class="aspect-video relative">
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                        </div>

                        <div class="p-8 md:p-12">
                            {{-- Meta --}}
                            <div class="flex items-center gap-4 text-sm text-slate-500 mb-6">
                                <time
                                    class="flex items-center gap-1 bg-slate-100 px-3 py-1 rounded-full text-slate-700 font-medium">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $post->published_at->format('d M Y') }}
                                </time>
                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                <span>{{ $post->author ?? 'SOHO Güvenlik' }}</span>
                            </div>

                            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8 leading-tight">
                                {{ $post->title }}
                            </h1>

                            <div class="prose prose-lg prose-slate max-w-none">
                                {!! $post->content !!}
                            </div>

                            {{-- Tags --}}
                            @if(!empty($post->tags))
                                <div class="border-t border-slate-100 mt-12 pt-8">
                                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Etiketler</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($post->tags as $tag)
                                            <a href="#"
                                                class="text-sm font-semibold text-brand-600 bg-brand-50 hover:bg-brand-100 px-3 py-1.5 rounded-lg transition-colors">
                                                #{{ $tag }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </article>

                    {{-- Share --}}
                    <div
                        class="mt-8 flex items-center justify-between bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                        <span class="font-bold text-slate-900">Bu yazıyı paylaş:</span>
                        <div class="flex gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="w-10 h-10 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                                target="_blank"
                                class="w-10 h-10 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                                target="_blank"
                                class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-8">

                    {{-- Newsletter --}}
                    <div
                        class="bg-gradient-to-br from-brand-900 to-slate-900 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10">
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-2">Bültene Abone Olun</h3>
                            <p class="text-slate-300 text-sm mb-6">En son güvenlik trendlerinden ve kampanyalardan haberdar
                                olun.</p>

                            <form action="#" class="space-y-3">
                                <input type="email" placeholder="E-posta adresiniz"
                                    class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:bg-white/20 focus:outline-none transition-colors">
                                <button type="button"
                                    class="w-full bg-white text-brand-900 font-bold py-3 rounded-xl hover:bg-brand-50 transition shadow-lg">Abone
                                    Ol</button>
                            </form>
                        </div>
                    </div>

                    {{-- Contact Card --}}
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-slate-100">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Bir Projeniz mi Var?</h3>
                        <p class="text-slate-600 mb-6">Uzman ekibimizle görüşmek için hemen bizimle iletişime geçin.</p>
                        <a href="{{ route('contact') }}"
                            class="w-full block text-center bg-brand-600 text-white font-bold py-3 rounded-xl hover:bg-brand-700 transition">
                            İletişime Geçin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection