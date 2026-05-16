<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\POS\SaleController;

// Route::middleware(['auth'])
//     ->prefix('pos')
//     ->name('pos.')
//     ->group(function () {

//  // POS main page
//         Route::get('/sales', [SaleController::class, 'index'])
//             ->name('sales.index');

//         // create sale (checkout)
//         Route::post('/sales', [SaleController::class, 'store'])
//             ->name('sales.store');

//         // Orders
//         Route::get('/pending-orders', [PosController::class, 'pendingOrder'])
//             ->name('orders.pending');

//         Route::get('/paid-orders', [PosController::class, 'paidAllOrder'])
//             ->name('orders.paid');

//         Route::get('/view-order/{id}', [PosController::class, 'viewOrder'])
//             ->name('orders.view');

//         Route::get('/paid/{id}', [PosController::class, 'paidOrder'])
//             ->name('orders.markPaid');

//         // Invoice
//         Route::get('/invoice/{orderId}', [App\Http\Controllers\pdfController::class, 'downloadInvoice'])
//             ->name('invoice.download');
//     });

Route::prefix('pos')
    ->name('pos.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/sales', [PosController::class, 'index'])->name('sales.index');
        Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

        Route::get('/pending-orders', [PosController::class, 'pendingOrder'])->name('orders.pending');
        Route::get('/paid-orders', [PosController::class, 'paidAllOrder'])->name('orders.paid');
    });
