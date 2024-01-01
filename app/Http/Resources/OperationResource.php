<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class OperationResource extends JsonResource
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
            'key' => $this->key,
            'label' => $this->label,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'roleOperations' => RoleOperationResource::collection($this->whenLoaded('roleOperations')),

        ];
    }
}
