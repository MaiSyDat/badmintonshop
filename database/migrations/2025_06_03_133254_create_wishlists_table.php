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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->uuid('wishlist_id')->primary(); // UUID
            $table->uuid('user_id')->comment('Khóa ngoại tới bảng users');
            $table->uuid('product_id')->comment('Khóa ngoại tới bảng products');
            $table->timestamps(); // added_date sẽ dùng created_at

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->unique(['user_id', 'product_id']); // Đảm bảo mỗi người dùng chỉ thêm 1 sản phẩm 1 lần
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
