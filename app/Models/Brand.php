<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';
    public $incrementing = true;
    protected $fillable = ['brand_name', 'brand_logo_url'];

    /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
