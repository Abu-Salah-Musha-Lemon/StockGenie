<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CustomerController;
/*
|--------------------------------------------------------------------------
| Web Routes (Root)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile', [ProfileController::class, 'updateEmployee'])->name('profile.updateEmployee');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // User profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Employee profile information
    Route::patch('/profile/employee', [ProfileController::class, 'updateEmployee'])
        ->name('profile.updateEmployee');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// customers
Route::resource('customers', CustomerController::class);

use App\Http\Controllers\WarehouseController;
// warehouses
Route::resource('warehouses', WarehouseController::class)
    ->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);



require __DIR__.'/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pos.php';
require __DIR__ . '/reports.php';
