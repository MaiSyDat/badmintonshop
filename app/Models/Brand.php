<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Brand extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'brand_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'brand_name',
        'brand_logo_url',
    ];

    public function getRouteKeyName()
    {
        return 'brand_id';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
