<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id'; // Khóa chính là role_id
    public $incrementing = true;       // Có tự tăng
    protected $fillable = ['role_name'];

    // Mối quan hệ với User: Một Role có nhiều Users
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
