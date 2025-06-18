<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VariantAttributeValue extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'value_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'attribute_id',
        'attribute_value'
    ];

    public function attribute()
    {
        return $this->belongsTo(VariantAttribute::class, 'attribute_id');
    }
}
