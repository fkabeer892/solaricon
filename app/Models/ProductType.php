<?php

namespace App\Models;
use App\Model;

class ProductType extends Model{

    protected $fillable = [
                        "name",
        
    
    ];

    
                    function productTypesAttributes(){
            return $this->hasMany( ProductTypesAttribute::class);
        }
                function products(){
            return $this->hasMany( Product::class);
        }
            
}
