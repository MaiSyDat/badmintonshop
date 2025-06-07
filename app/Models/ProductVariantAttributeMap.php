<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductVariantAttributeMap extends Model
{
    use HasFactory;

    protected $table = 'product_variant_attribute_map'; // Đảm bảo đúng tên bảng
    protected $primaryKey = 'map_id';
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
        'variant_id',
        'value_id',
    ];

    /**
     * Get the product variant that owns the map entry.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }

    /**
     * Get the attribute value that owns the map entry.
     */
    public function attributeValue()
    {
        return $this->belongsTo(VariantAttributeValue::class, 'value_id', 'value_id');
    }
}
