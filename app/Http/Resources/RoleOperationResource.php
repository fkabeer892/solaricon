<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class RoleOperationResource extends JsonResource
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
            'role_id' => $this->role_id,
            'operation_id' => $this->operation_id,
            'access_level' => $this->access_level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'role' => RoleResource::collection($this->whenLoaded('role')),
            'operation' => OperationResource::collection($this->whenLoaded('operation')),

        ];
    }
}
