<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <-- Đảm bảo dòng này có

class Category extends Model
{
    use HasFactory, HasUuids; // <-- Đảm bảo HasUuids được sử dụng ở đây

    protected $primaryKey = 'category_id'; // <-- Khai báo khóa chính là category_id
    protected $keyType = 'string';     // <-- Khóa chính là string (cho UUID)
    public $incrementing = false;     // <-- Khóa chính không tự tăng (cho UUID)

    protected $fillable = [
        'category_name',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'category_id';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    // Quan hệ cha-con (nếu có cột parent_id và muốn hỗ trợ cây danh mục)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }
}
