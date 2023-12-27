<?php

namespace App\Models;
use App\Model;

class ProductAttribute extends Model{

    protected $fillable = [
                        "product_id",
                    "attribute_id",
                    "value",
        
    
    ];

                    function product(){
            return $this->belongsTo( Product::class);
        }
                function attribute(){
            return $this->belongsTo( Attribute::class);
        }
            
    
}
