<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $config = $this->config();

        // 3 sản phẩm nổi bật
        $featuredProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // 6 sản phẩm mới nhất
        $latestProducts = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Top 3 danh mục nhiều sản phẩm
        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(3)
            ->get();

        // Tất cả danh mục và thương hiệu
        $categories = Category::all();
        $brands = Brand::all();

        // Gợi ý sản phẩm mới
        $nameproduct = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Yêu thích
        $wishlistIds = [];
        if (Auth::check()) {
            $wishlistIds = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        // Giỏ hàng
        $cart = session('cart', []);

        return view('user.index', compact(
            'config',
            'featuredProducts',
            'latestProducts',
            'categories',
            'brands',
            'topCategories',
            'nameproduct',
            'wishlistIds',
            'cart'
        ));
    }


    public function news()
    {
        return view('user.page.news');
    }

    public function about()
    {
        return view('user.page.about');
    }

    private function config()
    {
        return [
            'js' => [
                '../assets/js/component/slider.js',
                '../assets/js/page/home.js',
            ]
        ];
    }
}
