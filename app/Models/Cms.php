<?php

namespace App\Models;

use App\Model;

class Cms extends Model
{

    protected $fillable = [
        "cms_type_id",
        "user_id",
        "name",
        "content",
        "email"
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function cmsType()
    {
        return $this->belongsTo(CmsType::class);
    }


}
