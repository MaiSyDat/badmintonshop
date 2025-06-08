<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // <--- THÊM DÒNG NÀY

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids; // <--- THÊM HasUuids VÀO ĐÂY

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    // BỎ HOẶC XOÁ HOÀN TOÀN PHƯƠNG THỨC BOOT() NÀY
    // Lý do: HasUuids trait đã tự động xử lý việc tạo UUID cho khóa chính.
    // Việc giữ lại có thể gây xung đột hoặc không cần thiết.
    /*
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    */


    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'phone_number',
        'address',
        'role_id',
        'is_active',
        'avatar', // Đảm bảo avatar có trong fillable nếu bạn muốn cập nhật nó
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Mối quan hệ với Role: Một User thuộc về một Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    // Mối quan hệ với Orders: Một User có nhiều Orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    // Mối quan hệ với Reviews: Một User có nhiều Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'user_id');
    }

    // Mối quan hệ với Wishlists: Một User có nhiều Wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'user_id');
    }

    // Phân quyền
    public function isAdmin()
    {
        return $this->role && $this->role->role_name === 'Admin';
    }

    public function isStaff()
    {
        return $this->role && $this->role->role_name === 'Staff';
    }

    public function isCustomer()
    {
        return $this->role && $this->role->role_name === 'Customer';
    }
}
