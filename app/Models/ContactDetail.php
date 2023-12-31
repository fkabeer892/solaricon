<?php

namespace App\Models;

use App\Model;

class ContactDetail extends Model
{

    protected $fillable = [
        "contact_id",
        "contact_key",
        "contact_value"
    ];

    function contact()
    {
        return $this->belongsTo(Contact::class);
    }


}
