@extends('layouts.app')

@section('content')
    <div class="bg-white py-12 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <!-- Breadcrumb -->
                <nav class="flex mb-8" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Ana Sayfa</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                                <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Hizmetler</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                                <span class="ml-4 text-sm font-medium text-gray-500"
                                    aria-current="page">{{ $service->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                @if($service->image)
                    <img class="aspect-[16/9] w-full rounded-xl bg-gray-50 object-cover shadow-lg mb-10"
                        src="{{ Storage::url($service->image) }}" alt="{{ $service->title }}">
                @endif

                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl text-center mb-10">
                    {{ $service->title }}</h1>

                <div class="mt-6 prose prose-lg prose-indigo mx-auto text-gray-600">
                    {!! $service->content !!}
                </div>

                <div class="mt-16 border-t border-gray-100 pt-10 grid grid-cols-1 gap-8 sm:grid-cols-2">
                    <div class="rounded-2xl bg-gray-50 p-8 text-center sm:text-left">
                        <h3 class="text-lg font-semibold text-gray-900">Arıza mı var?</h3>
                        <p class="mt-2 text-sm text-gray-600">Teknik ekibimiz en kısa sürede müdahale etsin.</p>
                        <a href="{{ route('requests.fault') }}"
                            class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500">Arıza
                            Talebi Oluştur &rarr;</a>
                    </div>
                    <div class="rounded-2xl bg-gray-50 p-8 text-center sm:text-left">
                        <h3 class="text-lg font-semibold text-gray-900">Envanter mi Lazım?</h3>
                        <p class="mt-2 text-sm text-gray-600">İhtiyacınız olan donanım veya yazılımı talep edin.</p>
                        <a href="{{ route('requests.inventory') }}"
                            class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500">Envanter
                            Talebi Oluştur &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection