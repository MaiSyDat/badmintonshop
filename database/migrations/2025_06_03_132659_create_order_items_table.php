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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('order_item_id')->primary(); // UUID
            $table->uuid('order_id')->comment('Khóa ngoại tới bảng orders');
            $table->uuid('product_id')->comment('Khóa ngoại tới bảng prodcut');
            $table->integer('quantity')->comment('Số lượng sản phẩm');
            $table->decimal('price_per_item', 10, 2)->comment('Giá sản phẩm tại thời điểm đặt hàng');
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
