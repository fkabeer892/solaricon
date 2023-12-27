<?php

namespace App\Models;
use App\Model;

class Role extends Model{

    protected $fillable = [
                        "name",
        
    
    ];

    
                    function userRoles(){
            return $this->hasMany( UserRole::class);
        }
                function users(){
            return $this->hasMany( User::class);
        }
                function roleOperations(){
            return $this->hasMany( RoleOperation::class);
        }
            
}
