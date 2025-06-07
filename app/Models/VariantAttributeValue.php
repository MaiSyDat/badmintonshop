<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttributeValue extends Model
{
    use HasFactory;

    protected $primaryKey = 'value_id';
    public $incrementing = true;
    protected $fillable = ['attribute_id', 'attribute_value'];

    /**
     * Get the attribute that owns the value.
     */
    public function attribute()
    {
        return $this->belongsTo(VariantAttribute::class, 'attribute_id', 'attribute_id');
    }

    /**
     * The product variants that have this attribute value.
     */
    public function productVariants()
    {
        // This is a many-to-many relationship through 'product_variant_attribute_map'
        return $this->belongsToMany(
            ProductVariant::class,
            'product_variant_attribute_map',
            'value_id',
            'variant_id',
            'value_id',
            'variant_id'
        );
    }
}
