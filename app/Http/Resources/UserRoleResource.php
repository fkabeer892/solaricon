<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class UserRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'user' => new UserResource($this->whenLoaded('user')),
    'role' => new RoleResource($this->whenLoaded('role')),
    
        ];
    }
}
