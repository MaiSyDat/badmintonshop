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
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('brand_id'); // Khóa chính tự tăng
            $table->string('brand_name', 100)->unique()->comment('Tên thương hiệu');
            $table->string('brand_logo_url', 255)->nullable()->comment('URL logo thương hiệu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
