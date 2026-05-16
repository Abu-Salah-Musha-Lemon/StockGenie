<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\SalesReportController;

Route::prefix('reports')
    ->name('reports.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/sales', [SalesReportController::class, 'index'])
            ->name('sales.index');

        Route::get('/sales/today', [SalesReportController::class, 'todaySalesReport'])
            ->name('sales.today');

        Route::get('/sales/monthly', [SalesReportController::class, 'monthlySalesReport'])
            ->name('sales.monthly');

        Route::get('/sales/yearly', [SalesReportController::class, 'yearlySalesReport'])
            ->name('sales.yearly');
    });