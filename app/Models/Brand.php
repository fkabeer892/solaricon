<?php

namespace App\Models;

use App\Model;

class Brand extends Model
{

    protected $fillable = [
        "name"
    ];


    function products()
    {
        return $this->hasMany(Product::class);
    }

}
