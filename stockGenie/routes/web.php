<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\customerController;
// use App\Http\Controllers\AdvanceSalaryController;
// use App\Http\Controllers\ExpensesController;
// use App\Http\Controllers\AttendanceController;
// use App\Http\Controllers\PosController;
// use App\Http\Controllers\CardController;
// use App\Http\Controllers\SalesReportController;
// use App\Http\Controllers\SalaryController;
// use App\Http\Controllers\SettingController;
// use App\Http\Controllers\DashboardsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
   
    // employee route
    Route::resource('employees', EmployeeController::class);

    // supplier route
    Route::resource('suppliers', SuppliersController::class);

    // Categories route
    Route::resource('categories', CategoryController::class);

     // Product route
     Route::resource('products', ProductController::class);

     Route::get('/update-product-qty-view', [ProductController::class, 'updateProductQtyView'])->name('updateProductQtyView');
     Route::get('/update-product-qty/{id}', [ProductController::class, 'updateProductQty'])->name('updateProductQty');
 

    // customer route
    Route::get('/all-customer', [customerController::class, 'index'])->name('customer.all-customer');
    Route::get('/add-customer', [customerController::class, 'create'])->name('customer.add-customer');

    Route::post('/insert-customer', [customerController::class, 'store'])->name('addCustomer');
    Route::get('/view-customer{id}', [customerController::class, 'show']);
    Route::get('/delete-customer{id}', [customerController::class, 'destroy']);
    Route::get('/edit-customer{id}', [customerController::class, 'edit']);
    Route::post('/update-customer{id}', [customerController::class, 'update']);

    

    // Salary route
    Route::get('/all-salary', [salaryController::class, 'index'])->name('salary.all-salary');
    Route::get('/add-salary', [salaryController::class, 'create'])->name('salary.add-salary');

    Route::post('/insert-salary', [salaryController::class, 'store'])->name('store');
    Route::get('/view-salary{id}', [salaryController::class, 'show']);
    Route::get('/delete-salary{id}', [salaryController::class, 'destroy']);
    Route::get('/edit-salary{id}', [salaryController::class, 'edit']);
    Route::post('/update-salary{id}', [salaryController::class, 'update']);

   
   
    // Expense route
    Route::get('/all-expense', [ExpensesController::class, 'index'])->name('allExpense');
    Route::get('/add-expense', [ExpensesController::class, 'create'])->name('addExpense');
    Route::get('/today-expense', [ExpensesController::class, 'todayExpense'])->name('todayExpense');
    Route::get('/monthly-expense', [ExpensesController::class, 'monthlyExpense'])->name('monthlyExpense');
    Route::get('/yearly-expense', [ExpensesController::class, 'yearlyExpense'])->name('yearlyExpense');

    Route::post('/insert-expense', [ExpensesController::class, 'store']);
    Route::get('/view-expense/{id}', [ExpensesController::class, 'show']);
    Route::get('/delete-expense/{id}', [ExpensesController::class, 'destroy']);
    Route::get('/edit-expense/{id}', [ExpensesController::class, 'edit']);
    Route::post('/update-expense/{id}', [ExpensesController::class, 'update']);

    // monthly expense Route

    Route::get('/January-expense', [ExpensesController::class, 'JanuaryExpense'])->name('JanuaryExpense');
    Route::get('/February-expense', [ExpensesController::class, 'FebruaryExpense'])->name('FebruaryExpense');
    Route::get('/March-expense', [ExpensesController::class, 'MarchExpense'])->name('MarchExpense');
    Route::get('/April-expense', [ExpensesController::class, 'AprilExpense'])->name('AprilExpense');
    Route::get('/May-expense', [ExpensesController::class, 'MayExpense'])->name('MayExpense');
    Route::get('/June-expense', [ExpensesController::class, 'JuneExpense'])->name('JuneExpense');
    Route::get('/July-expense', [ExpensesController::class, 'JulyExpense'])->name('JulyExpense');
    Route::get('/August-expense', [ExpensesController::class, 'AugustExpense'])->name('AugustExpense');
    Route::get('/September-expense', [ExpensesController::class, 'SeptemberExpense'])->name('SeptemberExpense');
    Route::get('/October-expense', [ExpensesController::class, 'OctoberExpense'])->name('OctoberExpense');
    Route::get('/November-expense', [ExpensesController::class, 'NovemberExpense'])->name('NovemberExpense');
    Route::get('/December-expense', [ExpensesController::class, 'DecemberExpense'])->name('DecemberExpense');

    // attendance

    Route::get('/all-attendance', [AttendanceController::class, 'index'])->name('allAttendance');
    Route::get('/take-attendance', [AttendanceController::class, 'create'])->name('takeAttendance');
    Route::post('/insert-attendance', [AttendanceController::class, 'store'])->name('attendanceEmployee');
    Route::get('/edit-attendance/{id}', [AttendanceController::class, 'edit'])->name('editAttendance');
    Route::post('/update-attendance', [AttendanceController::class, 'update']);
    Route::get('/delete-attendance/{edit_date}', [AttendanceController::class, 'destroy']);

    // Pos
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::get('/pending-orders', [PosController::class, 'pendingOrder'])->name('pendingOrder');
    Route::get('/view-order/{id}', [PosController::class, 'viewOrder'])->name('viewOrder');
    Route::get('/view-paid-order/{id}', [PosController::class, 'viewPaidOrder'])->name('viewPaidOrder');
    Route::get('/paid/{id}', [PosController::class, 'paidOrder']);
    Route::get('/paid-orders', [PosController::class, 'paidAllOrder'])->name('paidOrder');


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
