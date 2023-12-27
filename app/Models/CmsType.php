<?php

namespace App\Models;
use App\Model;

class CmsType extends Model{

    protected $fillable = [
                        "name",
        
    
    ];

    
                    function cms(){
            return $this->hasMany( Cm::class);
        }
            
}
