<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pos\SaleController;

Route::middleware(['auth'])
    ->prefix('pos')
    ->name('pos.')
    ->group(function () {

        Route::post('/sales', [SaleController::class, 'store'])
            ->name('sales.store');
        
         Route::post('/sales', [SaleController::class, 'store'])
            ->name('sales.store');
    });
