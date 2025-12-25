<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\UploadController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\BlogController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\ReferenceController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\TestimonialController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\ContactController;
use App\Http\Controllers\Api\Admin\OfferController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/admin/login', [AuthController::class, 'login']);

Route::prefix('public')->group(function () {
    Route::get('/services', function () {
        return \App\Models\Service::where('is_active', true)->latest()->get();
    });
    Route::get('/blogs', function () {
        return \App\Models\Blog::latest()->get();
    });
    Route::get('/references', function () {
        return \App\Models\Reference::where('is_active', true)->latest()->get();
    });
    Route::get('/sliders', function () {
        return \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
    });
    Route::get('/testimonials', function () {
        return \App\Models\Testimonial::where('is_active', true)->latest()->get();
    });
    Route::get('/products', function () {
        return \App\Models\Product::latest()->get();
    });
    Route::get('/menus', function () {
        return \App\Models\Menu::where('is_active', true)->whereNull('parent_id')->with('children')->orderBy('order')->get();
    });
    Route::get('/settings', function () {
        return \App\Models\Setting::all()->pluck('value', 'key');
    });
});

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::post('/upload', [UploadController::class, 'store']);

        Route::apiResource('services', ServiceController::class);
        Route::apiResource('blogs', BlogController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('references', ReferenceController::class);
        Route::apiResource('sliders', SliderController::class);
        Route::apiResource('testimonials', TestimonialController::class);
        Route::apiResource('menus', MenuController::class);
        Route::apiResource('contacts', ContactController::class);
        Route::apiResource('offers', OfferController::class);
        Route::apiResource('settings', SettingController::class);
    });
});
