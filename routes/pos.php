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




Route::middleware('auth')
    ->prefix('pos')
    ->name('pos.')
    ->group(function () {

        Route::get('/', [PosController::class, 'index'])
            ->name('index');

        Route::post('/cart/add', [PosController::class, 'addCart'])
            ->name('cart.add');

        Route::post('/cart/update/{rowId}', [PosController::class, 'updateCart'])
            ->name('cart.update');

        Route::post('/cart/delete/{rowId}', [PosController::class, 'deleteCart'])
            ->name('cart.delete');

        Route::post('/cart/clear', [PosController::class, 'clearCart'])
            ->name('cart.clear');

        Route::post('/checkout', [PosController::class, 'finalInvoice'])
            ->name('checkout');

        Route::get('/pending-orders', [PosController::class, 'pendingOrder'])
            ->name('orders.pending');

        Route::get('/pending-orders/{id}', [PosController::class, 'viewOrder'])
            ->name('orders.view');

        Route::post('/pending-orders/{id}/paid', [PosController::class, 'paidOrder'])
            ->name('orders.paid');

        Route::get('/paid-orders', [PosController::class, 'paidAllOrder'])
            ->name('orders.paid.index');
    });
