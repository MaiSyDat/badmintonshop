<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Thêm dòng này

class Product extends Model
{
    use HasFactory, HasUuids; // Thêm HasUuids vào đây

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_name',
        'short_description',
        'long_description',
        'base_price',
        'brand_id',
        'category_id',
        'main_image_url',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'gallery_image_urls' // Thêm gallery_image_urls
    ];

    // Cast gallery_image_urls to array if you store it as JSON
    protected $casts = [
        'gallery_image_urls' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
    // Thêm các mối quan hệ khác nếu có
}
