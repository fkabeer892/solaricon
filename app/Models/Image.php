<?php

namespace App\Models;

use App\Model;

class Image extends Model
{

    protected $fillable = [
        "name",
        "object_type",
        "object_id",
        "file_name"
    ];


}
