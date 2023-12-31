<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "mobile",
        "email_verified_at",
        "password",
        "remember_token",
        "contact_id",
        "role_id",
        "status_id",
        "branch_id"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function status()
    {
        return $this->belongsTo(Status::class);
    }

    function role()
    {
        return $this->belongsTo(Role::class);
    }

    function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    function orders()
    {
        return $this->hasMany(Order::class);
    }

    function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    function cms()
    {
        return $this->hasMany(Cms::class);
    }

    function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
