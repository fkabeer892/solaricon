<?php

namespace App\Models;
use App\Model;

class FailedJob extends Model{

    protected $fillable = [
                        "uuid",
                    "connection",
                    "queue",
                    "payload",
                    "exception",
                    "failed_at",
        
    
    ];

                    function branche(){
            return $this->belongsTo( Branche::class);
        }
            
    
}
