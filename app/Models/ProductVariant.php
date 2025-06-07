<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    use HasFactory;

    protected $primaryKey = 'variant_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'product_id',
        'sku',
        'additional_price',
        'stock_quantity',
        'variant_image_url',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'additional_price' => 'decimal:2', // Cast to decimal with 2 precision
    ];

    /**
     * Get the product that owns the variant.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /**
     * Get the attributes values for the product variant.
     */
    public function attributeValues()
    {
        // This is a many-to-many relationship through 'product_variant_attribute_map'
        return $this->belongsToMany(
            VariantAttributeValue::class,
            'product_variant_attribute_map',
            'variant_id',
            'value_id',
            'variant_id',
            'value_id'
        );
    }

    /**
     * Get the order items for the product variant.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }
}
