<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    //
    public function index($id)
    {
        $product = Product::with('brand')->findOrFail($id);
        return view('user.page.product-detail', compact('product'));
    }
}
