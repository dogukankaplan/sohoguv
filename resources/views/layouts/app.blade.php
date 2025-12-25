<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOHO Güvenlik') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Static Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    <!-- Inline Styles for Apple-like Feel if Vite not compiled -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="h-full flex flex-col">
    @include('layouts.navigation')

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-50 border-t border-gray-100" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <span class="text-2xl font-bold tracking-tight text-gray-900">SOHO<span
                            class="text-indigo-600">.</span></span>
                    <p class="text-sm leading-6 text-gray-600">
                        Profesyonel güvenlik ve teknoloji çözümleri.
                    </p>
                </div>
            </div>
            <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-500">&copy; {{ date('Y') }} SOHO Güvenlik Sistemleri. Tüm hakları
                    saklıdır.</p>
            </div>
        </div>
    </footer>
</body>

</html>