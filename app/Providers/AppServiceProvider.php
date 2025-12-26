<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // Share services
            if (\Illuminate\Support\Facades\Schema::hasTable('services')) {
                \Illuminate\Support\Facades\View::share('globalServices', \App\Models\Service::orderBy('title')->get());
            } else {
                \Illuminate\Support\Facades\View::share('globalServices', collect([]));
            }

            // Share settings
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \Illuminate\Support\Facades\View::share('globalSettings', \App\Models\Setting::pluck('value', 'key'));
            } else {
                \Illuminate\Support\Facades\View::share('globalSettings', collect([]));
            }

            // Share site identity
            if (\Illuminate\Support\Facades\Schema::hasTable('site_identities')) {
                \Illuminate\Support\Facades\View::share('siteIdentity', \App\Models\SiteIdentity::first());
            } else {
                \Illuminate\Support\Facades\View::share('siteIdentity', null);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('globalServices', collect([]));
            \Illuminate\Support\Facades\View::share('globalSettings', collect([]));
            \Illuminate\Support\Facades\View::share('siteIdentity', null);
        }
    }
}
