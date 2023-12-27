<?php

namespace App\Models;
use App\Model;

class Category extends Model{

    protected $fillable = [
                        "parent_id",
                    "name",
        
    
    ];

                    function category(){
            return $this->belongsTo( Category::class);
        }
            
                    function products(){
            return $this->hasMany( Product::class);
        }
                function categories(){
            return $this->hasMany( Category::class);
        }
            
}
