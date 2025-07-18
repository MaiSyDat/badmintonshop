<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ danh mục
        View::share('categories', Category::all());

        // Chia sẻ thương hiệu
        View::share('brands', Brand::all());

        // Chia sẻ sản phẩm mới
        View::share('nameproduct', Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get());

        // Chia sẻ giỏ hàng từ session (nếu có)
        View::composer('*', function ($view) {
            $cart = session('cart', []); // hoặc Session::get('cart', []);
            $view->with('cart', $cart);
        });
    }
}
