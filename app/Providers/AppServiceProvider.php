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
        //
        // Share dữ liệu cho mọi view
        View::share('categories', Category::all());
        View::share('brands', Brand::all());
        View::share('nameproduct', Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get());
    }
}
