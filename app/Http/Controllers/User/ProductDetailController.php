<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        // Lấy sản phẩm trước
        $product = Product::with('brand')->findOrFail($id);

        // Sau đó mới lấy đánh giá
        $reviews = $product->reviews()->where('is_approved', true)->get();
        $ratingCount = $reviews->count();
        $averageRating = $ratingCount > 0 ? number_format($reviews->avg('rating'), 1) : 0;

        $ratingDistribution = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        return view('user.page.product-detail', compact(
            'product',
            'reviews',
            'ratingCount',
            'averageRating',
            'ratingDistribution'
        ));
    }
}
