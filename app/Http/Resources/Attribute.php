<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Attribute extends JsonResource
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
            'type' => $this->type,
            'handler' => $this->handler,
            'default' => $this->default,

            'productTypesAttributes' => ProductTypesAttributeResource::collection($this->whenLoaded('productTypesAttributes')),
            'productAttributes' => ProductAttributeResource::collection($this->whenLoaded('productAttributes')),
            'categoryAttributes' => CategoryAttributeResource::collection($this->whenLoaded('categoryAttributes')),

        ];
    }
}
