<?php

namespace App\Models;
use App\Model;

class Contact extends Model{

    protected $fillable = [
                        "user_id",
                    "address",
                    "area",
                    "city",
                    "state",
                    "country",
                    "mobile",
                    "phone",
                    "latitude",
                    "longitude",
        
    
    ];

                    function user(){
            return $this->belongsTo( User::class);
        }
            
                    function users(){
            return $this->hasMany( User::class);
        }
                function orders(){
            return $this->hasMany( Order::class);
        }
                function contactDetail(){
            return $this->hasMany( ContactDetail::class);
        }
                function branches(){
            return $this->hasMany( Branche::class);
        }
            
}
