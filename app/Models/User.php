<?php

namespace App\Models;
use App\Model;

class User extends Model{

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
                    "branch_id",
        
    
    ];

                    function status(){
            return $this->belongsTo( Status::class);
        }
                function role(){
            return $this->belongsTo( Role::class);
        }
                function contact(){
            return $this->belongsTo( Contact::class);
        }
                function branche(){
            return $this->belongsTo( Branche::class);
        }
                function branche(){
            return $this->belongsTo( Branche::class);
        }
            
                    function userRoles(){
            return $this->hasMany( UserRole::class);
        }
                function orderItems(){
            return $this->hasMany( OrderItem::class);
        }
                function orders(){
            return $this->hasMany( Order::class);
        }
                function contacts(){
            return $this->hasMany( Contact::class);
        }
                function cms(){
            return $this->hasMany( Cm::class);
        }
                function carts(){
            return $this->hasMany( Cart::class);
        }
            
}
