<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class RoleOperation extends JsonResource
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
            'role_id' => $this->role_id,
            'operation_id' => $this->operation_id,
            'access_level' => $this->access_level,

            'role' => RoleResource::collection($this->whenLoaded('role')),
            'operation' => OperationResource::collection($this->whenLoaded('operation')),

        ];
    }
}
