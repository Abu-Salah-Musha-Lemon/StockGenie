<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\SalesReportController;

Route::middleware(['auth'])
    ->prefix('reports')
    ->name('reports.')
    ->group(function () {

        Route::get('/sales', [SalesReportController::class, 'index'])
            ->name('sales.index');
    });
