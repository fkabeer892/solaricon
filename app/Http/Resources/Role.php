<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Role extends JsonResource
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
            'name' => $this->name,

            'userRoles' => UserRoleResource::collection($this->whenLoaded('userRoles')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'roleOperations' => RoleOperationResource::collection($this->whenLoaded('roleOperations')),

        ];
    }
}
