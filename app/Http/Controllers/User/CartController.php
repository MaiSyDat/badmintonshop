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

    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $cart = new Cart();
        $cart->items = session('cart', []);
        $cart->add($product, $quantity);

        // Tính lại tổng giá trị giỏ hàng sau khi thêm
        $total = collect($cart->items)->sum(fn($item) => $item->price * $item->quantity);
        session(['cart_total' => $total]);

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ');
    }


    public function deleteCart($id, Cart $cart)
    {
        $cart->removeItem($id);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công');
    }

    public function updateCart($id, $quantity)
    {
        $cartItems = session()->get('cart', []);

        if (isset($cartItems[$id])) {
            $cartItems[$id]->quantity = $quantity;
            session(['cart' => $cartItems]);

            $itemTotal = $cartItems[$id]->price * $quantity;
            $cartTotal = collect($cartItems)->sum(fn($item) => $item->price * $item->quantity);

            // Lưu lại cart_total vào session
            session(['cart_total' => $cartTotal]);

            return response()->json([
                'success' => true,
                'item_total' => $itemTotal,
                'cart_total' => $cartTotal
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}
