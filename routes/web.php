<?php

use Domain\Blogging\Reports\PostsCreatedOverPeriod;
use Illuminate\Support\Facades\Route;
use Spatie\Period\Period;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/test', function () {
    $report = new PostsCreatedOverPeriod(
        Period::make('2022-01-24', '2022-01-29'),
    );
    
    dd($report->totalPosts());
});

/**
 * Post Routes
 */
Route::prefix('posts')->as('posts:')->group(function () {
    Route::post('/', App\Http\Controllers\Web\Posts\StoreController::class)->name('store');
});