<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/**
 * Post Routes
 */
Route::prefix('posts')->as('posts:')->group(function () {
    Route::post('/', App\Http\Controllers\Web\Posts\StoreController::class)->name('store');
});