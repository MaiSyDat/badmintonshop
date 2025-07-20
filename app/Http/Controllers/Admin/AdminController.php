<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('payment_status', 'Paid')
            ->whereIn('order_status', ['Shipped', 'Delivered'])
            ->sum('total_amount');

        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalProducts = Product::count();

        $topProduct = Product::withCount('reviews')
            ->orderByDesc('reviews_count')
            ->first();

        return view('admin.index', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'topProduct' => $topProduct,
        ]);
    }
}
