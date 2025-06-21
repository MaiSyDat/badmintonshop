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
        Schema::create('product_extend', function (Blueprint $table) {
            $table->uuid('product_id')->comment('Khóa ngoại tham chiếu tới bảng products');
            $table->string('sku', 100)->unique()->comment('Mã SKU');
            $table->string('color', 100)->comment('Màu sắc của biến thể');
            $table->string('weight_WU', 100)->comment('Trọng lượng vợt');
            $table->string('length', 100)->comment('Chiều dài vợt (tính bằng mm)');
            $table->string('grip_size_G', 100)->comment('Kích thước cán vợt');
            $table->string('lbs', 100)->comment('Sức căng dây vợt (đơn vị lbs)');
            $table->string('material', 100)->comment('Chất liệu chính của vợt');
            $table->string('balance', 100)->comment('Độ cân bằng của vợt');
            $table->string('stiffness', 100)->comment('Độ cứng của thân vợt');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('Khoản giảm giá');
            $table->integer('quantity')->default(0)->comment('Số lượng tồn kho');
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
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
