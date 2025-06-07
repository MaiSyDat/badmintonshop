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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('variant_id')->primary(); // UUID
            $table->uuid('product_id')->comment('Khóa ngoại tới bảng products');
            $table->string('sku', 100)->unique()->comment('Mã SKU duy nhất');
            $table->decimal('additional_price', 10, 2)->default(0.00)->comment('Giá thêm vào so với base_price');
            $table->integer('stock_quantity')->default(0)->comment('Số lượng tồn kho');
            $table->string('variant_image_url', 255)->nullable()->comment('URL ảnh riêng cho biến thể');
            $table->boolean('is_available')->default(true)->comment('Trạng thái sẵn có');
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade'); // Xóa cascade khi sản phẩm bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
