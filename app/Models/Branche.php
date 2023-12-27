<?php

namespace App\Models;
use App\Model;

class Branche extends Model{

    protected $fillable = [
                        "name",
                    "contact_id",
        
    
    ];

                    function contact(){
            return $this->belongsTo( Contact::class);
        }
            
                    function users(){
            return $this->hasMany( User::class);
        }
                function expenses(){
            return $this->hasMany( Expens::class);
        }
            
}
