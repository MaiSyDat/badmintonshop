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
        Schema::create('product_variant_attribute_map', function (Blueprint $table) {
            $table->uuid('map_id')->primary(); // UUID
            $table->uuid('variant_id')->comment('Khóa ngoại tới bảng product_variants');
            $table->uuid('value_id')->comment('Khóa ngoại tới bảng variant_attribute_values');
            $table->timestamps();

            $table->foreign('variant_id')->references('variant_id')->on('product_variants')->onDelete('cascade');
            $table->foreign('value_id')->references('value_id')->on('variant_attribute_values')->onDelete('cascade');
            $table->unique(['variant_id', 'value_id']); // Đảm bảo mỗi cặp variant-attribute_value là duy nhất
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attribute_map');
    }
};
