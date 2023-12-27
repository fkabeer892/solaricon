<?php

namespace App\Models;
use App\Model;

class UserRole extends Model{

    protected $fillable = [
                        "user_id",
                    "role_id",
        
    
    ];

                    function user(){
            return $this->belongsTo( User::class);
        }
                function role(){
            return $this->belongsTo( Role::class);
        }
            
    
}
