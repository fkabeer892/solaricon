<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductTypesAttribute extends JsonResource
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
            'product_type_id' => $this->product_type_id,
            'attribute_id' => $this->attribute_id,

            'productType' => ProductTypeResource::collection($this->whenLoaded('productType')),
            'attribute' => AttributeResource::collection($this->whenLoaded('attribute')),

        ];
    }
}
