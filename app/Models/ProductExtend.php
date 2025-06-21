<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductExtend extends Model
{
    use HasFactory;

    protected $table = 'product_extend';

    protected $fillable = [
        'product_id',
        'sku',
        'color',
        'weight_WU',
        'length',
        'grip_size_G',
        'lbs',
        'material',
        'balance',
        'stiffness',
        'discount',
        'quantity',
        'sub_image',
        'is_available',
    ];

    protected $casts = [
        'discount' => 'decimal:2',
        'quantity' => 'integer',
        'is_available' => 'boolean',
        'sub_image' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
