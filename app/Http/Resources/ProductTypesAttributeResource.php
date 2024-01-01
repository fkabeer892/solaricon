<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductTypesAttributeResource extends JsonResource
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
            'product_type_id' => $this->product_type_id,
            'attribute_id' => $this->attribute_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'productType' => ProductTypeResource::collection($this->whenLoaded('productType')),
            'attribute' => AttributeResource::collection($this->whenLoaded('attribute')),

        ];
    }
}
