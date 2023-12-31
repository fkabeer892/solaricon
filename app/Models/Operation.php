<?php

namespace App\Models;

use App\Model;

class Operation extends Model
{

    protected $fillable = [
        "key",
        "label"
    ];


    function roleOperations()
    {
        return $this->hasMany(RoleOperation::class);
    }

}
