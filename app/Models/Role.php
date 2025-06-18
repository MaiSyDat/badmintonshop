<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <-- Đảm bảo dòng này có và được import

class Role extends Model
{
    use HasFactory, HasUuids; // <-- Đảm bảo HasUuids được sử dụng ở đây

    protected $primaryKey = 'role_id'; // <-- Khai báo khóa chính
    protected $keyType = 'string';     // <-- Khóa chính là string (cho UUID)
    public $incrementing = false;     // <-- Khóa chính không tự tăng (cho UUID)

    protected $fillable = [
        'role_name',
        'description',
    ];

    // 🔑 Quan trọng: Cho Route Model Binding dùng role_id thay vì id
    public function getRouteKeyName()
    {
        return 'role_id'; // <-- Laravel sẽ dùng 'role_id' để tìm model trong route
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
