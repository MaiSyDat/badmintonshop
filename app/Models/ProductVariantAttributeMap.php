<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProductVariantAttributeMap extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'map_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'variant_id',
        'value_id'
    ];

    // Optional: define relationships if needed
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function attributeValue()
    {
        return $this->belongsTo(VariantAttributeValue::class, 'value_id');
    }
}
