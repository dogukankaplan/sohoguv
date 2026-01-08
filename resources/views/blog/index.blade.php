@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50">

        {{-- Hero Section --}}
        <section class="relative pt-32 pb-20 overflow-hidden bg-slate-900">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900"></div>

            <div class="container-custom relative z-10 text-center text-white">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">Blog & Haberler</h1>
                <p class="text-xl text-slate-300 max-w-2xl mx-auto">
                    Güvenlik teknolojileri, sektörel haberler ve ipuçları hakkında en güncel yazılarımız.
                </p>
            </div>
        </section>

        {{-- Blog Posts Grid --}}
        <section class="py-20">
            <div class="container-custom">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($posts as $post)
                        <article
                            class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-slate-100 flex flex-col h-full group">

                            <a href="{{ route('blog.show', $post->slug) }}" class="relative h-60 overflow-hidden shrink-0">
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                                {{-- Date Badge --}}
                                <div
                                    class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-slate-900 shadow-sm">
                                    {{ $post->published_at->format('d M Y') }}
                                </div>
                            </a>

                            <div class="p-6 flex flex-col flex-grow">
                                {{-- Tags --}}
                                @if(!empty($post->tags))
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(array_slice($post->tags, 0, 2) as $tag)
                                            <span
                                                class="text-xs font-semibold text-brand-600 bg-brand-50 px-2 py-1 rounded-md">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <h2 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-brand-600 transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <p class="text-slate-600 text-sm mb-6 line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>

                                <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                        class="text-brand-600 font-semibold text-sm hover:underline">
                                        Devamını Oku &rarr;
                                    </a>
                                    <span class="text-xs text-slate-400 font-medium">5 dk okuma</span>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="inline-flex p-4 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-medium text-slate-900">Henüz blog yazısı eklenmedi.</h3>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection