<?php

namespace App\Models;
use App\Model;

class Attribute extends Model{

    protected $fillable = [
                        "name",
                    "type",
                    "handler",
                    "default",
        
    
    ];

    
                    function productTypesAttributes(){
            return $this->hasMany( ProductTypesAttribute::class);
        }
                function productAttributes(){
            return $this->hasMany( ProductAttribute::class);
        }
                function categoryAttributes(){
            return $this->hasMany( CategoryAttribute::class);
        }
            
}
