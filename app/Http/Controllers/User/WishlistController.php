<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Hiển thị danh sách yêu thích
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $wishlistIds = $wishlists->pluck('product_id')->toArray();

        return view('user.page.wishlist', compact('wishlists', 'wishlistIds'));
    }

    // Thêm sản phẩm vào danh sách yêu thích
    public function store(Request $request)
    {
        $product_id = $request->input('product_id');

        // Nếu đã tồn tại, không thêm nữa
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
            ]);
        }

        return response()->json(['success' => true]);
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function destroy(Request $request)
    {
        $product_id = $request->input('product_id');

        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->delete();

        return response()->json(['success' => true]);
    }
}
