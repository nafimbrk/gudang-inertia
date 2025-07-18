<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::prefix('category')->group(function () {
        Route::name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('admin');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('supplier')->group(function () {
        Route::name('supplier.')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('index');
            Route::get('/create', [SupplierController::class, 'create'])->name('create');
            Route::post('/', [SupplierController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('edit')->middleware('admin');
            Route::put('/{id}', [SupplierController::class, 'update'])->name('update');
            Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('warehouse')->group(function () {
        Route::name('warehouse.')->group(function () {
            Route::get('/', [WarehouseController::class, 'index'])->name('index');
            Route::get('/create', [WarehouseController::class, 'create'])->name('create');
            Route::post('/', [WarehouseController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [WarehouseController::class, 'edit'])->name('edit');
            Route::put('/{id}', [WarehouseController::class, 'update'])->name('update');
            Route::delete('/{id}', [WarehouseController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('item')->group(function () {
        Route::name('item.')->group(function () {
            Route::get('/', [ItemController::class, 'index'])->name('index');
            Route::get('/create', [ItemController::class, 'create'])->name('create');
            Route::post('/', [ItemController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ItemController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ItemController::class, 'update'])->name('update');
            Route::delete('/{id}', [ItemController::class, 'destroy'])->name('destroy');
            Route::post('/category/store', [ItemController::class, 'storeCategory'])->name('category.store');
            Route::post('/supplier/store', [ItemController::class, 'storeSupplier'])->name('supplier.store');
            Route::post('/warehouse/store', [ItemController::class, 'storeWarehouse'])->name('warehouse.store');
            Route::post('/unit/store', [ItemController::class, 'storeUnit'])->name('unit.store');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('unit')->group(function () {
        Route::name('unit.')->group(function () {
            Route::get('/', [UnitController::class, 'index'])->name('index');
            Route::get('/create', [UnitController::class, 'create'])->name('create');
            Route::post('/', [UnitController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UnitController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UnitController::class, 'update'])->name('update');
            Route::delete('/{id}', [UnitController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('transaction')->group(function () {
        Route::name('transaction.')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('index');
            Route::get('/create', [TransactionController::class, 'create'])->name('create');
            Route::post('/', [TransactionController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TransactionController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::get('/register-view', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login-view', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
