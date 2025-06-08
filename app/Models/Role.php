<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Thêm dòng này

class Role extends Model
{
    use HasFactory, HasUuids; // Thêm HasUuids vào đây

    protected $primaryKey = 'role_id'; // Đảm bảo đúng tên khóa chính
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'role_id', // Nếu bạn muốn gán role_id thủ công khi tạo (ít khi xảy ra với UUID)
        'role_name',
        'description',
    ];

    // Một vai trò có nhiều người dùng
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
