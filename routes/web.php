<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// DEBUG ROUTE - Remove after testing
Route::get('/debug-home', function () {
    $controller = new \App\Http\Controllers\HomeController();
    ob_start();
    try {
        $result = $controller->index();
        $viewData = $result->getData();
        ob_end_clean();

        return response()->json([
            'success' => true,
            'sections_count' => $viewData['sections']->count(),
            'services_count' => $viewData['services']->count(),
            'clients_count' => $viewData['clients']->count(),
            'testimonials_count' => $viewData['testimonials']->count(),
            'sections_types' => $viewData['sections']->pluck('type')->toArray(),
        ]);
    } catch (\Exception $e) {
        ob_end_clean();
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

Route::get('/hizmet/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/hizmetler', [ServiceController::class, 'index'])->name('services.index');
Route::get('/cozumler', [ServiceController::class, 'solutions'])->name('solutions.index');

Route::get('/hakkimizda', [AboutController::class, 'index'])->name('about');
Route::get('/iletisim', [ContactController::class, 'index'])->name('contact');
Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');
Route::get('/referanslar', [ReferenceController::class, 'index'])->name('references');
Route::get('/teklif', [QuoteController::class, 'index'])->name('quote');

Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/ariza-talebi', [RequestController::class, 'fault'])->name('requests.fault');
Route::get('/envanter-talebi', [RequestController::class, 'inventory'])->name('requests.inventory');
Route::post('/talepler', [RequestController::class, 'store'])->name('requests.store');

Route::get('/sitemap.xml', function () {
    $services = \App\Models\Service::all();
    return response()->view('sitemap', compact('services'))->header('Content-Type', 'text/xml');
});
