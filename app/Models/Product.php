<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
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
        'gallery_image_urls'
    ];

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
        return $this->hasMany(ProductExtend::class, 'product_id', 'product_id');
    }

    // dùng cho edit_productt
    public function product_extend()
    {
        return $this->hasOne(ProductExtend::class, 'product_id', 'product_id');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }
}
