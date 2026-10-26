<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SuppliersController::class);

        Route::resource('employees', EmployeeController::class);
        Route::resource('expenses', ExpenseController::class);
        Route::resource('attendance', AttendanceController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('departments', DepartmentController::class);
        Route::resource('positions', PositionController::class);

});
Route::middleware(['auth'])->group(function () {

    Route::get('/employee/dashboard', [DashboardController::class, 'employee'])
        ->name('employee.dashboard');

});
    //     // Products
    //     // Route::resource('products', ProductController::class)
    //     //     ->except(['create', 'show']);
    //     Route::resource('/products', ProductController::class);


    //     // // Categories
    //     // Route::resource('categories', CategoryController::class)
    //     //     ->except(['create', 'show']);
   
    //     Route::resource('cards', CardController::class)->except(['create', 'show']);

    //     Route::patch('cards/{id}/block', [CardController::class, 'block'])->name('cards.block'); 

    //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //     // employee route
    // Route::get('/add-employee', [EmployeeController::class, 'addEmployee'])->name('employee.add-employee');
    // Route::get('/all-employee', [EmployeeController::class, 'allEmployee'])->name('employee.all-employee');

    // Route::post('/insert-employee', [EmployeeController::class, 'store'])->name('addEmployee');
    // Route::get('/view-employee{id}', [EmployeeController::class, 'viewEmployee']);
    // Route::get('/delete-employee{id}', [EmployeeController::class, 'deleteEmployee']);
    // Route::get('/edit-employee{id}', [EmployeeController::class, 'editEmployee']);
    // Route::post('/update-employee{id}', [EmployeeController::class, 'updateEmployee']);

    // // supplier route
    // Route::get('/all-supplier', [SuppliersController::class, 'index'])->name('supplier.all-supplier');
    // Route::get('/add-supplier', [SuppliersController::class, 'create'])->name('supplier.add-supplier');

    // Route::post('/insert-supplier', [SuppliersController::class, 'store']);
    // Route::get('/view-supplier{id}', [SuppliersController::class, 'show']);
    // Route::get('/delete-supplier{id}', [SuppliersController::class, 'destroy']);
    // Route::get('/edit-supplier{id}', [SuppliersController::class, 'edit']);
    // Route::post('/update-supplier{id}', [SuppliersController::class, 'update']);
    // Route::resource('supplier', SuppliersController::class);

    // // Categories route
    // Route::resource('category', CategoryController::class);

    // // Product route
    // Route::resource('products', ProductController::class);

    // Route::get('/update-product-qty-view', [ProductController::class, 'updateProductQtyView'])->name('updateProductQtyView');
    // Route::get('/update-product-qty/{id}', [ProductController::class, 'updateProductQty'])->name('updateProductQty');

    // // Product route
    // Route::get('/all-product', [ProductController::class, 'index'])->name('allProduct');
    // Route::get('/add-product', [ProductController::class, 'create'])->name('addProduct');
    
    // Route::post('/insert-product', [ProductController::class, 'store']);
    // Route::post('/insert-product-modal', [ProductController::class, 'storeModal']);
    // Route::get('/view-product/{id}', [ProductController::class, 'show']);
    // Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);
    // Route::get('/edit-product/{id}', [ProductController::class, 'edit']);
    // Route::post('/update-product/{id}', [ProductController::class, 'update']);
    // Route::get('/update-product-qty-view', [ProductController::class, 'updateProductQtyView'])->name('updateProductQtyView');
    // Route::get('/update-product-qty/{id}', [ProductController::class, 'updateProductQty'])->name('updateProductQty');
       
    // // Expense route
    // Route::get('/all-expense', [ExpenseController::class, 'index'])->name('allExpense');
    // Route::get('/add-expense', [ExpenseController::class, 'create'])->name('addExpense');
    // Route::get('/today-expense', [ExpenseController::class, 'todayExpense'])->name('todayExpense');
    // Route::get('/monthly-expense', [ExpenseController::class, 'monthlyExpense'])->name('monthlyExpense');
    // Route::get('/yearly-expense', [ExpenseController::class, 'yearlyExpense'])->name('yearlyExpense');

    // Route::post('/insert-expense', [ExpenseController::class, 'store']);
    // Route::get('/view-expense/{id}', [ExpenseController::class, 'show']);
    // Route::get('/delete-expense/{id}', [ExpenseController::class, 'destroy']);
    // Route::get('/edit-expense/{id}', [ExpenseController::class, 'edit']);
    // Route::post('/update-expense/{id}', [ExpenseController::class, 'update']);

    // // monthly expense Route

    // Route::get('/January-expense', [ExpenseController::class, 'JanuaryExpense'])->name('JanuaryExpense');
    // Route::get('/February-expense', [ExpenseController::class, 'FebruaryExpense'])->name('FebruaryExpense');
    // Route::get('/March-expense', [ExpenseController::class, 'MarchExpense'])->name('MarchExpense');
    // Route::get('/April-expense', [ExpenseController::class, 'AprilExpense'])->name('AprilExpense');
    // Route::get('/May-expense', [ExpenseController::class, 'MayExpense'])->name('MayExpense');
    // Route::get('/June-expense', [ExpenseController::class, 'JuneExpense'])->name('JuneExpense');
    // Route::get('/July-expense', [ExpenseController::class, 'JulyExpense'])->name('JulyExpense');
    // Route::get('/August-expense', [ExpenseController::class, 'AugustExpense'])->name('AugustExpense');
    // Route::get('/September-expense', [ExpenseController::class, 'SeptemberExpense'])->name('SeptemberExpense');
    // Route::get('/October-expense', [ExpenseController::class, 'OctoberExpense'])->name('OctoberExpense');
    // Route::get('/November-expense', [ExpenseController::class, 'NovemberExpense'])->name('NovemberExpense');
    // Route::get('/December-expense', [ExpenseController::class, 'DecemberExpense'])->name('DecemberExpense');

    // // attendance

    // Route::get('/all-attendance', [AttendanceController::class, 'index'])->name('allAttendance');
    // Route::get('/take-attendance', [AttendanceController::class, 'create'])->name('takeAttendance');
    // Route::post('/insert-attendance', [AttendanceController::class, 'store'])->name('attendanceEmployee');
    // Route::get('/edit-attendance/{id}', [AttendanceController::class, 'edit'])->name('editAttendance');
    // Route::post('/update-attendance', [AttendanceController::class, 'update']);
    // Route::get('/delete-attendance/{edit_date}', [AttendanceController::class, 'destroy']);

    // // Card Controller
    // Route::post('/add-card', [CardController::class, 'store']);
    // Route::post('/update-card/{rowId}', [CardController::class, 'update']);
    // Route::get('/delete-cart/{rowId}', [CardController::class, 'destroy']);
    // Route::get('/create-invoice', [CardController::class, 'createInvoice']);
    // Route::get('/final-invoice', [CardController::class, 'finalInvoice']);
    // Route::get('/due-pay/{id}', [CardController::class, 'duePay']);

