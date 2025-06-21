<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $config = $this->config();

        // 3 sản phẩm nổi bật
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 6 sản phẩm mới nhất (ngoại trừ 3 sản phẩm nổi bật nếu muốn)
        $latestProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            // ->skip(3) // Bỏ qua 3 sản phẩm đầu nếu trùng featured
            ->take(6)
            ->get();

        // 3 danh mục có nhiều sản phẩm nhất
        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(3)
            ->get();

        // all categories
        $categories = Category::all();

        $nameproduct = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Brand all
        $brands = Brand::all();

        return view('user.index', compact('config', 'featuredProducts', 'latestProducts', 'categories', 'brands', 'topCategories', 'nameproduct'));
    }

    private function config()
    {
        return [
            'js' => [
                '../assets/js/component/nav.js',
                '../assets/js/component/slider.js',
                '../assets/js/page/home.js',
            ]
        ];
    }
}
