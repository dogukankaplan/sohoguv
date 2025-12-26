<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-neutral-bg antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOHO Güvenlik') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Alpine.js for dropdowns -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css'])

</head>

<body class="h-full flex flex-col">
    @include('layouts.navigation')

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-primary-500 border-t border-primary-400" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        
        <div class="container-custom pb-8 pt-16 sm:pt-24 lg:pt-32">
            <!-- Newsletter -->
            <div class="xl:grid xl:grid-cols-3 xl:gap-8 border-b border-primary-400 pb-12 mb-12">
                <div class="space-y-8">
                    <span class="text-2xl font-black tracking-tight text-white flex items-center gap-2">
                        @if(setting('logo'))
                        <img src="{{ Storage::url(setting('logo')) }}" alt="{{ setting('site_name', 'SOHO') }}" class="h-8">
                        @else
                        <span>SOHO</span>
                        <span class="text-secondary-500">Güvenlik</span>
                        @endif
                    </span>
                    <p class="text-sm leading-6 text-primary-100">
                        {{ setting('footer_about', 'Güvenlik ve teknoloji altyapılarınız için profesyonel çözümler.') }}
                    </p>
                </div>
                <div class="mt-16 xl:col-span-2 xl:mt-0">
                    <h3 class="text-sm font-semibold leading-6 text-white">{{ setting('footer_newsletter_title', 'Bültenimize Abone Olun') }}</h3>
                    <p class="mt-2 text-sm leading-6 text-primary-100">{{ setting('footer_newsletter_desc', 'E-posta ile güncellemelerden haberdar olun.') }}</p>
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="mt-6 sm:flex sm:max-w-md">
                        @csrf
                        <label for="email-address" class="sr-only">{{ setting('placeholder_email', 'E-posta adresi') }}</label>
                        <input type="email" name="email" id="email-address" autocomplete="email" required class="w-full min-w-0 appearance-none rounded-lg border-0 bg-white px-4 py-3 text-base text-primary-500 shadow-sm placeholder:text-neutral-medium focus:ring-2 focus:ring-secondary-500 sm:w-64 sm:text-sm sm:leading-6" placeholder="{{ setting('placeholder_email', 'E-posta adresiniz') }}">
                        <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                            <button type="submit" class="btn-accent w-full sm:w-auto">
                                {{ setting('btn_subscribe', 'Abone Ol') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Links -->
            <div class="grid grid-cols-2 gap-8 xl:grid-cols-4">
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Kurumsal</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{ route('about') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">{{ setting('page_about', 'Hakkımızda') }}</a></li>
                        <li><a href="{{ route('references') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">{{ setting('page_references', 'Referanslar') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">{{ setting('page_contact', 'İletişim') }}</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">{{ setting('page_services', 'Hizmetler') }}</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        @if(isset($globalServices))
                            @foreach($globalServices->take(4) as $service)
                            <li><a href="{{ route('services.show', $service->slug) }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">{{ $service->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">Destek</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li><a href="{{ route('requests.fault') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">Arıza Talebi</a></li>
                        <li><a href="{{ route('requests.inventory') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">Envanter Talebi</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm leading-6 text-primary-100 hover:text-white transition">İletişim Formu</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold leading-6 text-white">{{ setting('page_contact', 'İletişim') }}</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li class="text-sm leading-6 text-primary-100">{{ setting('phone', '+90 (555) 123 45 67') }}</li>
                        <li class="text-sm leading-6 text-primary-100">{{ setting('email', 'info@sohoguvenlik.com') }}</li>
                        <li class="text-sm leading-6 text-primary-100">{{ setting('address', 'İstanbul, Türkiye') }}</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-16 border-t border-primary-400 pt-8 sm:mt-20 lg:mt-24 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-xs leading-5 text-primary-200">{{ str_replace('[YEAR]', date('Y'), setting('copyright', '© [YEAR] SOHO Güvenlik Sistemleri. Tüm hakları saklıdır.')) }}</p>
                
                <div class="flex space-x-6 mt-4 sm:mt-0">
                    @if(isset($globalSettings['facebook']) && $globalSettings['facebook'])
                    <a href="{{ $globalSettings['facebook'] }}" class="text-primary-200 hover:text-white transition" target="_blank">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    @endif
                    
                    @if(isset($globalSettings['instagram']) && $globalSettings['instagram'])
                    <a href="{{ $globalSettings['instagram'] }}" class="text-primary-200 hover:text-white transition" target="_blank">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                    </a>
                    @endif
                    
                    @if(isset($globalSettings['linkedin']) && $globalSettings['linkedin'])
                    <a href="{{ $globalSettings['linkedin'] }}" class="text-primary-200 hover:text-white transition" target="_blank">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>
</body>

</html>