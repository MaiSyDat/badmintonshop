<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;

    protected $primaryKey = 'attribute_id';
    public $incrementing = true;
    protected $fillable = ['attribute_name'];

    /**
     * Get the attribute values for the variant attribute.
     */
    public function values()
    {
        return $this->hasMany(VariantAttributeValue::class, 'attribute_id', 'attribute_id');
    }
}
