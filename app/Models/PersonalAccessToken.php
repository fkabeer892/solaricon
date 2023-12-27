<?php

namespace App\Models;
use App\Model;

class PersonalAccessToken extends Model{

    protected $fillable = [
                        "tokenable_type",
                    "tokenable_id",
                    "name",
                    "token",
                    "abilities",
                    "last_used_at",
                    "expires_at",
        
    
    ];

                    function orderitem(){
            return $this->belongsTo( Orderitem::class);
        }
            
    
}
