<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str; // Import Str facade

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Tự động tạo UUID khi tạo user mới
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) { // Chỉ tạo nếu chưa có
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        // 'user_id', // Có thể bỏ dòng này
        'username',
        'email',
        'password',
        'full_name',
        'phone_number',
        'address',
        'role_id',
        'is_active',
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
}
