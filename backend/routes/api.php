<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\ReferenceController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\ContactController;
use App\Http\Controllers\Api\Admin\OfferController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Public\PageController;
use App\Http\Controllers\Api\Public\ContactController as PublicContactController;
use App\Http\Controllers\Api\Public\OfferController as PublicOfferController;

// Public Routes
Route::get('/debug-db', function () {
    try {
        return [
            'database_default' => config('database.default'),
            'database_name' => \Illuminate\Support\Facades\DB::connection()->getDatabaseName(),
            'service_count' => \App\Models\Service::count(),
        ];
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
    }
});

Route::prefix('public')->group(function () {
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/services', [PageController::class, 'services']);
    Route::get('/services/{slug}', [PageController::class, 'serviceDetail']);
    Route::get('/blogs', [PageController::class, 'blogs']);
    Route::get('/blogs/{slug}', [PageController::class, 'blogDetail']);
    Route::get('/references', [PageController::class, 'references']);
    Route::get('/settings', [PageController::class, 'settings']);
    Route::get('/menus', [PageController::class, 'menus']);
    Route::get('/sliders', [PageController::class, 'sliders']);

    Route::post('/contact', PublicContactController::class);
    Route::post('/offer', PublicOfferController::class);
    Route::get('/products', [App\Http\Controllers\Api\Public\ProductController::class, 'index']);
    Route::get('/products/{slug}', [App\Http\Controllers\Api\Public\ProductController::class, 'show']);
    Route::get('/sitemap.xml', [App\Http\Controllers\Api\Public\SitemapController::class, 'index']);
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::apiResource('services', ServiceController::class);
        Route::apiResource('blogs', BlogController::class);
        Route::apiResource('references', ReferenceController::class);
        Route::apiResource('sliders', SliderController::class);
        Route::apiResource('menu-items', \App\Http\Controllers\Api\Admin\MenuItemController::class);
        Route::apiResource('testimonials', \App\Http\Controllers\Api\Admin\TestimonialController::class);
        Route::apiResource('faqs', \App\Http\Controllers\Api\Admin\FaqController::class);

        Route::get('settings', [SettingController::class, 'index']);
        Route::post('settings', [SettingController::class, 'update']);

        Route::apiResource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::apiResource('offers', OfferController::class)->only(['index', 'show', 'destroy']);
        Route::post('/upload', [\App\Http\Controllers\Api\Admin\UploadController::class, 'store']);
        Route::apiResource('products', \App\Http\Controllers\Api\Admin\ProductController::class);
    });
});
