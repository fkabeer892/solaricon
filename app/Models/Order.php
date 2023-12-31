<?php

namespace App\Models;

use App\Model;

class Order extends Model
{

    protected $fillable = [
        "user_id",
        "cart_id",
        "order_number",
        "payment_address_id",
        "shipping_address_id",
        "total",
        "discount",
        "grand_total",
        "status_id"
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function status()
    {
        return $this->belongsTo(Status::class);
    }

    function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
