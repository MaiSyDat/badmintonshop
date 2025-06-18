<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Thêm dòng này

class Brand extends Model
{
    use HasFactory, HasUuids; // Sử dụng HasFactory và HasUuids

    protected $primaryKey = 'brand_id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Chỉ điền các trường CÓ TRONG DATABASE của bạn
    protected $fillable = [
        'brand_name',
        'brand_logo_url', // Đảm bảo tên cột là 'brand_logo_url'
    ];

    // Cho Route Model Binding dùng brand_id thay vì id
    public function getRouteKeyName()
    {
        return 'brand_id';
    }

    // Quan hệ với sản phẩm (nếu có bảng 'products' và cột 'brand_id' trong đó)
    // Nếu chưa có bảng 'products', bạn có thể tạm thời comment dòng này.
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
