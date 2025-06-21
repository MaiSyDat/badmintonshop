@extends('user.master_latout.main')

@section('title', 'Thanh toán momo')

@section('main')
    <div class="success-payment-demo">
        <h2 class="success-title">Mô phỏng Thanh toán MoMo</h2>
        <p class="success-text">Bạn đang mô phỏng thanh toán qua MoMo cho đơn hàng:</p>
        <ul class="success-info">
            <li><strong>Mã đơn hàng:</strong> {{ $order->order_id }}</li>
            <li><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} ₫</li>
        </ul>

        <form action="{{ route('checkout.momo.confirm', ['id' => $order->order_id]) }}" method="POST">
            @csrf
            <button type="submit" class="success-button">Xác nhận Đã Thanh Toán</button>
        </form>

        <a href="{{ route('home') }}" class="success-link">Quay lại trang chủ</a>
    </div>
@endsection
