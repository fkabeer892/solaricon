<?php

namespace App\Models;

use App\Model;

class RoleOperation extends Model
{

    protected $fillable = [
        "role_id",
        "operation_id",
        "access_level"
    ];

    function role()
    {
        return $this->belongsTo(Role::class);
    }

    function operation()
    {
        return $this->belongsTo(Operation::class);
    }


}
