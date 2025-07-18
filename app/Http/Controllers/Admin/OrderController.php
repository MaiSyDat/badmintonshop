<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('order_id', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            })
            ->when($request->order_status, fn($q) => $q->where('order_status', $request->order_status))
            ->when($request->payment_status, fn($q) => $q->where('payment_status', $request->payment_status))
            ->orderByDesc('order_date')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:Pending,Confirmed,Shipped,Cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return back()->with('success', 'Đã cập nhật trạng thái đơn hàng.');
    }

    public function myOrders()
    {
        $userId = Auth::id();
        $orders = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('user.page.my_order', compact('orders'));
    }
}
