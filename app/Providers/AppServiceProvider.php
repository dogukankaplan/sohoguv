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
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('globalServices', collect([]));
        }
    }
}
