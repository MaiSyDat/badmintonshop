<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
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
