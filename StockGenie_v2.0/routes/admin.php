<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Products
        // Route::resource('products', ProductController::class)
        //     ->except(['create', 'show']);
        Route::resource('/products', ProductController::class);


        // // Categories
        // Route::resource('categories', CategoryController::class)
        //     ->except(['create', 'show']);
   
        Route::resource('cards', CardController::class)->except(['create', 'show']);

        Route::patch('cards/{id}/block', [CardController::class, 'block'])->name('cards.block'); 

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});