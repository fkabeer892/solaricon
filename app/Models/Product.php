<?php

namespace App\Models;
use App\Model;

class Product extends Model{

    protected $fillable = [
                        "category_id",
                    "brand_id",
                    "product_type_id",
                    "name",
                    "description",
                    "purchase",
                    "sale",
                    "stock",
        
    
    ];

                    function productType(){
            return $this->belongsTo( ProductType::class);
        }
                function category(){
            return $this->belongsTo( Category::class);
        }
                function brand(){
            return $this->belongsTo( Brand::class);
        }
            
                    function productAttributes(){
            return $this->hasMany( ProductAttribute::class);
        }
                function orderItems(){
            return $this->hasMany( OrderItem::class);
        }
                function categoryAttributes(){
            return $this->hasMany( CategoryAttribute::class);
        }
                function cartItems(){
            return $this->hasMany( CartItem::class);
        }
            
}
