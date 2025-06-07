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
        Schema::create('variant_attribute_values', function (Blueprint $table) {
            $table->increments('value_id'); // Khóa chính tự tăng
            $table->unsignedInteger('attribute_id')->comment('Khóa ngoại tới bảng variant_attributes');
            $table->string('attribute_value', 100)->comment('Giá trị thuộc tính (Red, 3U, G5, etc.)');
            $table->timestamps();

            $table->foreign('attribute_id')->references('attribute_id')->on('variant_attributes')->onDelete('cascade');
            $table->unique(['attribute_id', 'attribute_value']); // Đảm bảo giá trị là duy nhất trong cùng một thuộc tính
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_attribute_values');
    }
};
