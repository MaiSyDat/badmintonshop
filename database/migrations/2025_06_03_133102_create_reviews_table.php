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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('review_id')->primary(); // UUID
            $table->uuid('product_id')->comment('Khóa ngoại tới bảng products');
            $table->uuid('user_id')->comment('Khóa ngoại tới bảng users');
            $table->integer('rating')->comment('Điểm đánh giá (1-5 sao)');
            $table->text('comment')->nullable()->comment('Nội dung bình luận');
            $table->boolean('is_approved')->default(false)->comment('Trạng thái duyệt đánh giá');
            $table->timestamps(); // review_date sẽ dùng created_at

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
