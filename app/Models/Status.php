<?php

namespace App\Models;
use App\Model;

class Status extends Model{

    protected $fillable = [
                        "object",
                    "name",
                    "handler",
                    "is_active",
        
    
    ];

    
                    function users(){
            return $this->hasMany( User::class);
        }
                function orders(){
            return $this->hasMany( Order::class);
        }
                function expenses(){
            return $this->hasMany( Expens::class);
        }
            
}
