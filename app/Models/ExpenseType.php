<?php

namespace App\Models;
use App\Model;

class ExpenseType extends Model{

    protected $fillable = [
                        "name",
                    "is_repeating",
                    "frequency",
                    "amount",
        
    
    ];

    
                    function expenses(){
            return $this->hasMany( Expens::class);
        }
            
}
