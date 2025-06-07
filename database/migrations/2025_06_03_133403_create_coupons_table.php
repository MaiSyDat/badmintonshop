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
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('coupon_id')->primary(); // UUID
            $table->string('coupon_code', 50)->unique()->comment('Mã giảm giá');
            $table->string('discount_type', 20)->comment('Loại giảm giá (Percentage, Fixed Amount)');
            $table->decimal('discount_value', 10, 2)->comment('Giá trị giảm giá');
            $table->decimal('min_order_amount', 10, 2)->default(0.00)->comment('Giá trị đơn hàng tối thiểu');
            $table->integer('usage_limit_per_user')->nullable()->comment('Giới hạn số lần dùng cho mỗi user');
            $table->integer('total_usage_limit')->nullable()->comment('Tổng số lần dùng tối đa');
            $table->dateTime('start_date')->comment('Ngày bắt đầu có hiệu lực');
            $table->dateTime('end_date')->comment('Ngày hết hạn');
            $table->boolean('is_active')->default(true)->comment('Trạng thái mã giảm giá');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
