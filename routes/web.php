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
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckOutController;
use App\Http\Controllers\user\ProductController as UserProductController;
use App\Http\Controllers\user\ProductDetailController;
use App\Http\Controllers\user\ReviewController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('user.index');
// });

// ADMIN & STAFF Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    route::resource('roles', RoleController::class);

    Route::resource('account', AccountController::class)->middleware('role:admin');

    Route::resource('categories', CategoriesController::class);

    Route::resource('product', ProductController::class);

    Route::resource('brands', BrandsController::class);

    Route::resource('coupon', CouponController::class);

    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');
});

// HOME
Route::get('/home', [UserController::class, 'index'])->name('home');

// Product
Route::get('/product', [UserProductController::class, 'index'])->name('product');
// Route AJAX để lọc và phân trang sản phẩm
Route::post('/product/filter', [UserProductController::class, 'ajaxFilter'])->name('product.filter');

// NEWS
Route::get('/news', [UserController::class, 'news'])->name('news');

// ABOUT
Route::get('/about', [UserController::class, 'about'])->name('about');

// PRODUCT - DETAIL
Route::get('/product-detail/{id}', [ProductDetailController::class, 'index'])->name('product-detail');

// REVIEWS
Route::resource('reviews', CouponController::class);
Route::post('/reviews/{product}', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
Route::post('/reviews/reply/{review}', [ReviewController::class, 'reply'])->middleware('auth')->name('reviews.reply');

// Cart
Route::group(['prefix' => 'cart'], function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'addtoCart'])->name('add.cart');
    Route::post('/add/{product}', [CartController::class, 'addtoCart'])->name('add.cart');
    Route::post('/delete/{product}', [CartController::class, 'deleteCart'])->name('delete.cart');
    Route::get('update/{id}/{quantity}', [CartController::class, 'updateCart'])->name('update.cart');
});

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'store'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'destroy'])->name('wishlist.remove');
});


// chekout
Route::get('/checkout', [CheckOutController::class, 'index'])->middleware('auth')->name('checkout.index');
Route::post('/checkout', [CheckOutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/momo/confirm/{id}', [CheckOutController::class, 'confirmMomo'])->name('checkout.momo.confirm');
Route::get('/success/{id}', [CheckOutController::class, 'showOrder'])->name('checkout.success');

// AUTH\
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
