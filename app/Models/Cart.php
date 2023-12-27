<?php

namespace App\Models;
use App\Model;

class Cart extends Model{

    protected $fillable = [
                        "user_id",
                    "total",
                    "discount",
                    "grand_total",
        
    
    ];

                    function user(){
            return $this->belongsTo( User::class);
        }
            
                    function orders(){
            return $this->hasMany( Order::class);
        }
                function cartItems(){
            return $this->hasMany( CartItem::class);
        }
            
}
