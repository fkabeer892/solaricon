<?php

namespace App\Models;

use App\Model;

class ProductTypesAttribute extends Model
{

    protected $fillable = [
        "product_type_id",
        "attribute_id"
    ];

    function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }


}
