<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class AttributeResource extends JsonResource
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
            'type' => $this->type,
            'handler' => $this->handler,
            'default' => $this->default,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'productTypesAttributes' => ProductTypesAttributeResource::collection($this->whenLoaded('productTypesAttributes')),
            'productAttributes' => ProductAttributeResource::collection($this->whenLoaded('productAttributes')),
            'categoryAttributes' => CategoryAttributeResource::collection($this->whenLoaded('categoryAttributes')),

        ];
    }
}
