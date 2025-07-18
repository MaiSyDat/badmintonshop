<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        // Lấy sản phẩm
        $product = Product::with('brand')->findOrFail($id);

        // Lấy các đánh giá đã duyệt
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

        // Kiểm tra xem người dùng đã mua sản phẩm và đã đánh giá chưa
        $user = Auth::user();
        $hasPurchased = false;
        $hasReviewed = false;

        if ($user) {
            // Đã mua: có đơn hàng chứa sản phẩm, đã giao thành công hoặc đang giao
            $hasPurchased = OrderItem::where('product_id', $id)
                ->whereHas('order', function ($query) use ($user) {
                    $query->where('user_id', $user->user_id)
                        ->whereIn('order_status', ['Delivered', 'Shipped']);
                })
                ->exists();

            // Đã đánh giá
            $hasReviewed = $product->reviews()
                ->where('user_id', $user->user_id)
                ->exists();
        }

        return view('user.page.product-detail', compact(
            'product',
            'reviews',
            'ratingCount',
            'averageRating',
            'ratingDistribution',
            'hasPurchased',
            'hasReviewed'
        ));
    }
}
