<?php

namespace App\Models;

use App\Model;

class OrderItem extends Model
{

    protected $fillable = [
        "order_id",
        "user_id",
        "product_name",
        "product_id",
        "quantity",
        "price",
        "discount",
        "inline_total"
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function order()
    {
        return $this->belongsTo(Order::class);
    }


}
