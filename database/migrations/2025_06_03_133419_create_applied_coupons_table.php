<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applied_coupons', function (Blueprint $table) {
            $table->uuid('applied_coupon_id')->primary(); // UUID
            $table->uuid('order_id')->comment('Khóa ngoại tới bảng orders');
            $table->uuid('coupon_id')->comment('Khóa ngoại tới bảng coupons');
            $table->decimal('discount_amount', 10, 2)->comment('Số tiền giảm giá thực tế');
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('coupon_id')->references('coupon_id')->on('coupons')->onDelete('restrict');
            $table->unique(['order_id', 'coupon_id']); // Đảm bảo mỗi coupon chỉ áp dụng 1 lần cho mỗi đơn hàng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_coupons');
    }
};
