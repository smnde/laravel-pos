<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class)->except(['show']);
    
    Route::get('users/roles/{id}', [UsersController::class, 'roles'])->name('users.roles');
    Route::put('users/roles/{id}', [UsersController::class, 'setRole'])->name('users.setRole');

    Route::post('users/permission', [UsersController::class, 'storePermission'])->name('users.storePermission');
    Route::get('users/role-permission', [UsersController::class, 'permission'])->name('users.permissions');
    Route::put('users/permission/{role}', [UsersController::class, 'setPermission'])->name('users.setPermission');

    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);

    Route::get('orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::post('orders/addproduct/{id}', [OrdersController::class, 'addProduct'])->name('orders.addProduct');
    Route::post('orders/removeproduct/{id}', [OrdersController::class, 'removeProduct'])->name('orders.removeProduct');
    Route::post('orders/increase/{id}', [OrdersController::class, 'increase']);
    Route::post('orders/decrease/{id}', [OrdersController::class, 'decrease']);
    Route::post('orders/save', [OrdersController::class, 'save'])->name('orders.save');
    Route::post('orders/clear', [OrdersController::class, 'clearCart'])->name('orders.clear');

    Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('sales/addproduct/{id}', [SalesController::class, 'addProduct'])->name('sales.addProduct');
    Route::post('sales/save', [SalesController::class, 'save'])->name('sales.save');
    Route::post('sales/removeproduct/{id}', [SalesController::class, 'removeProduct'])->name('sales.removeProduct');
    Route::post('sales/clear', [SalesController::class, 'clearCart'])->name('sales.clear');
    
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});