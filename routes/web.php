<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/hizmet/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/ariza-talebi', [RequestController::class, 'fault'])->name('requests.fault');
Route::get('/envanter-talebi', [RequestController::class, 'inventory'])->name('requests.inventory');
Route::post('/talepler', [RequestController::class, 'store'])->name('requests.store');
