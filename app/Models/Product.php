<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

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
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Mối quan hệ với Category: Một Product thuộc về một Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Mối quan hệ với Brand: Một Product thuộc về một Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    // Mối quan hệ với ProductVariants: Một Product có nhiều ProductVariants
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    // Mối quan hệ với Reviews: Một Product có nhiều Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }

    // Mối quan hệ với Wishlists: Một Product có nhiều Wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'product_id', 'product_id');
    }
}
