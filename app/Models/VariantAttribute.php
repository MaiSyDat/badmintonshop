<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VariantAttribute extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'attribute_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'attribute_name'
    ];

    public function values()
    {
        return $this->hasMany(VariantAttributeValue::class, 'attribute_id');
    }
}
