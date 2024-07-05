<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\pdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {return view('dashboard');});
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // supplier route
    Route::get('/all-supplier', [SuppliersController::class, 'index'])->name('supplier.all-supplier');
    Route::get('/add-supplier', [SuppliersController::class, 'create'])->name('supplier.add-supplier');

    Route::post('/insert-supplier', [SuppliersController::class, 'store']);
    Route::get('/view-supplier{id}', [SuppliersController::class, 'show']);
    Route::get('/delete-supplier{id}', [SuppliersController::class, 'destroy']);
    Route::get('/edit-supplier{id}', [SuppliersController::class, 'edit']);
    Route::post('/update-supplier{id}', [SuppliersController::class, 'update']);
    Route::resource('supplier', SuppliersController::class);

    // Categories route
    Route::resource('category', CategoryController::class);

    // Product route
    Route::resource('products', ProductController::class);

    Route::get('/update-product-qty-view', [ProductController::class, 'updateProductQtyView'])->name('updateProductQtyView');
    Route::get('/update-product-qty/{id}', [ProductController::class, 'updateProductQty'])->name('updateProductQty');

    // Product route
    Route::get('/all-product', [ProductController::class, 'index'])->name('allProduct');
    Route::get('/add-product', [ProductController::class, 'create'])->name('addProduct');
    
    Route::post('/insert-product', [ProductController::class, 'store']);
    Route::post('/insert-product-modal', [ProductController::class, 'storeModal']);
    Route::get('/view-product/{id}', [ProductController::class, 'show']);
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);
    Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/update-product-qty-view', [ProductController::class, 'updateProductQtyView'])->name('updateProductQtyView');
    Route::get('/update-product-qty/{id}', [ProductController::class, 'updateProductQty'])->name('updateProductQty');
       
    
    // Pos
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::get('/pending-orders', [PosController::class, 'pendingOrder'])->name('pendingOrder');
    Route::get('/view-order/{id}', [PosController::class, 'viewOrder'])->name('viewOrder');
    Route::get('/view-paid-order/{id}', [PosController::class, 'viewPaidOrder'])->name('viewPaidOrder');
    Route::get('/paid/{id}', [PosController::class, 'paidOrder'])->name('paid');
    // Route::get('/paid', [PosController::class, 'paidOrder'])->name('paid');
    Route::get('/paid-orders', [PosController::class, 'paidAllOrder'])->name('paidOrder');
    Route::get('/download-invoice/{orderId}', [pdfController::class, 'downloadInvoice'])->name('downloadInvoice');



    // Card Controller
    Route::post('/add-card', [CardController::class, 'store']);
    Route::post('/update-card/{rowId}', [CardController::class, 'update']);
    Route::get('/delete-cart/{rowId}', [CardController::class, 'destroy']);
    Route::get('/create-invoice', [CardController::class, 'createInvoice']);
    Route::get('/final-invoice', [CardController::class, 'finalInvoice']);
    Route::get('/due-pay/{id}', [CardController::class, 'duePay']);

    // sales Reports

    Route::get('/all-sales-report', [SalesReportController::class, 'index'])->name('allSalesReport');
    Route::get('/add-sales-report', [SalesReportController::class, 'create'])->name('addSalesReport');

    Route::get('/today-sales-report', [SalesReportController::class, 'todaySalesReport'])->name('todaySalesReport');
    Route::get('/monthly-sales-report', [SalesReportController::class, 'monthlySalesReport'])->name('monthlySalesReport');
    Route::get('/yearly-sales-report', [SalesReportController::class, 'yearlySalesReport'])->name('yearlySalesReport');

    // monthly Sales Report Route

    Route::get('/January-Sales-Report', [SalesReportController::class, 'JanuarySalesReport'])->name('JanuarySalesReport');
    Route::get('/February-Sales-Report', [SalesReportController::class, 'FebruarySalesReport'])->name('FebruarySalesReport');
    Route::get('/March-Sales-Report', [SalesReportController::class, 'MarchSalesReport'])->name('MarchSalesReport');
    Route::get('/April-Sales-Report', [SalesReportController::class, 'AprilSalesReport'])->name('AprilSalesReport');
    Route::get('/May-Sales-Report', [SalesReportController::class, 'MaySalesReport'])->name('MaySalesReport');
    Route::get('/June-Sales-Report', [SalesReportController::class, 'JuneSalesReport'])->name('JuneSalesReport');
    Route::get('/July-Sales-Report', [SalesReportController::class, 'JulySalesReport'])->name('JulySalesReport');
    Route::get('/August-Sales-Report', [SalesReportController::class, 'AugustSalesReport'])->name('AugustSalesReport');
    Route::get('/September-Sales-Report', [SalesReportController::class, 'SeptemberSalesReport'])->name('SeptemberSalesReport');
    Route::get('/October-Sales-Report', [SalesReportController::class, 'OctoberSalesReport'])->name('OctoberSalesReport');
    Route::get('/November-Sales-Report', [SalesReportController::class, 'NovemberSalesReport'])->name('NovemberSalesReport');
    Route::get('/December-Sales-Report', [SalesReportController::class, 'DecemberSalesReport'])->name('DecemberSalesReport');

    // yearly sales Report

    Route::get('/yearly-Sales-Report', [SalesReportController::class, 'yearlySalesReport'])->name('yearly-Sales-Reports');

});

require __DIR__.'/auth.php';
