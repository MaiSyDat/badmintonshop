<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.page.cart', compact('cart'));
    }

    public function addToCart(Product $product)
    {
        $cart = new Cart();

        // Gán lại dữ liệu cart cũ từ session (nếu có)
        $cart->items = session('cart', []);

        $cart->add($product);

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ');
    }

    public function deleteCart($id, Cart $cart)
    {
        $cart->removeItem($id);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công');
    }
}
