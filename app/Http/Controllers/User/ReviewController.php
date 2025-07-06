<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Lưu đánh giá từ người dùng
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        return redirect()->back()->with('success', 'Đánh giá đã được gửi và đang chờ phê duyệt.');
    }

    // Trả lời đánh giá (chỉ admin)
    public function reply(Request $request, $review_id)
    {
        $request->validate([
            'reply' => 'nullable|string|max:1000',
        ]);

        $review = Review::findOrFail($review_id);

        if (auth()->user()->isAdmin()) {
            $review->reply = $request->reply;
            $review->save();

            return redirect()->back()->with('success', 'Phản hồi đã được gửi.');
        }

        abort(403, 'Không có quyền phản hồi.');
    }
}
