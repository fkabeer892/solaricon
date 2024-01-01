<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ImageResource extends JsonResource
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
            'name' => $this->name,
            'object_type' => $this->object_type,
            'object_id' => $this->object_id,
            'file_name' => $this->file_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


        ];
    }
}
