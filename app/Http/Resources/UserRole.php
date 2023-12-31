<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class UserRole extends JsonResource
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
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'role' => RoleResource::collection($this->whenLoaded('role')),

        ];
    }
}
