<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CategoryAttribute extends JsonResource
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
            'product_id' => $this->product_id,
            'attribute_id' => $this->attribute_id,
            'value' => $this->value,

            'product' => ProductResource::collection($this->whenLoaded('product')),
            'attribute' => AttributeResource::collection($this->whenLoaded('attribute')),

        ];
    }
}
