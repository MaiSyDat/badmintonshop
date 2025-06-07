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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('product_id')->primary(); // Sử dụng UUID làm khóa chính
            $table->string('product_name')->comment('Tên sản phẩm');
            $table->string('short_description', 500)->nullable()->comment('Mô tả ngắn gọn');
            $table->text('long_description')->nullable()->comment('Mô tả chi tiết');
            $table->decimal('base_price', 10, 2)->comment('Giá cơ bản');
            $table->unsignedInteger('brand_id')->comment('Khóa ngoại tới bảng brands');
            $table->unsignedInteger('category_id')->comment('Khóa ngoại tới bảng categories');
            $table->string('main_image_url', 255)->nullable()->comment('URL ảnh đại diện');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hiển thị');
            $table->timestamps();

            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('restrict');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
