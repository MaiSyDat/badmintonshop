<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CouponController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});

// ADMIN & STAFF Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    route::resource('roles', RoleController::class);

    Route::resource('account', AccountController::class)->middleware('role:admin');

    Route::resource('categories', CategoriesController::class);

    Route::resource('product', ProductController::class);

    Route::resource('brands', BrandsController::class);

    Route::resource('coupon', CouponController::class);
});

// HOME
Route::get('/home', [UserController::class, 'index'])->name('home');

// AUTH\
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
