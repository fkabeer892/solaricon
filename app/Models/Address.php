<?php

namespace App\Models;
use App\Model;

class Address extends Model{

    protected $fillable = [
                        "street",
                    "area",
                    "city",
                    "state",
                    "country",
                    "mobile",
                    "phone",
                    "latitude",
                    "longitude",
        
    
    ];

    
    
}
