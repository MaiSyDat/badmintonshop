<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('order_id')->primary(); // UUID
            $table->uuid('user_id')->comment('Khóa ngoại tới bảng users');
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian đặt hàng');
            $table->decimal('total_amount', 10, 2)->comment('Tổng giá trị đơn hàng');
            $table->string('shipping_address', 500)->comment('Địa chỉ giao hàng');
            $table->string('billing_address', 500)->nullable()->comment('Địa chỉ thanh toán');
            $table->string('phone_number', 20)->comment('Số điện thoại người nhận');
            $table->string('order_status', 50)->default('Pending')->comment('Trạng thái đơn hàng');
            $table->string('payment_method', 50)->nullable()->comment('Phương thức thanh toán');
            $table->string('payment_status', 50)->default('Unpaid')->comment('Trạng thái thanh toán');
            $table->text('notes')->nullable()->comment('Ghi chú');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
