<?php

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
    return redirect(route('login'));
});

Auth::routes(['verify' => true]);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::prefix('admin')->middleware(['role:superuser'])->group(function () {
    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index']);
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', App\Http\Controllers\Backend\CategoryController::class);
    Route::get('categories/get/data', [App\Http\Controllers\Backend\CategoryController::class, 'data'])->name('categories.data');
    Route::put('categories/{slug}/restore', [App\Http\Controllers\Backend\CategoryController::class, 'restore'])->name('categories.restore');

    Route::resource('users', App\Http\Controllers\Backend\UserController::class);
    Route::get('users/get/data', [App\Http\Controllers\Backend\UserController::class, 'data'])->name('users.data');
    Route::put('users/{slug}/restore', [App\Http\Controllers\Backend\UserController::class, 'restore'])->name('users.restore');

    Route::resource('products', App\Http\Controllers\Backend\ProductController::class);
    Route::get('products/get/data', [App\Http\Controllers\Backend\ProductController::class, 'data'])->name('products.data');
    Route::put('products/{slug}/comment_store', [App\Http\Controllers\Backend\ProductController::class, 'commentStore'])->name('products.comment_store');
    Route::post('products/vote', [App\Http\Controllers\Backend\ProductController::class, 'vote'])->name('products.vote');
    Route::put('products/{slug}/restore', [App\Http\Controllers\Backend\ProductController::class, 'restore'])->name('products.restore');

});

Route::prefix('account')->middleware(['role:customer'])->group(function () {
    Route::get('/', [App\Http\Controllers\CustomerDashboard\DashboardController::class, 'index']);
    Route::get('dashboard', [App\Http\Controllers\CustomerDashboard\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', App\Http\Controllers\Backend\ProductController::class);
    Route::get('products/get/data', [App\Http\Controllers\Backend\ProductController::class, 'data'])->name('products.data');
    Route::put('products/{slug}/comment_store', [App\Http\Controllers\Backend\ProductController::class, 'commentStore'])->name('products.comment_store');
    Route::post('products/vote', [App\Http\Controllers\Backend\ProductController::class, 'vote'])->name('products.vote');
    Route::put('products/{slug}/restore', [App\Http\Controllers\Backend\ProductController::class, 'restore'])->name('products.restore');

});
