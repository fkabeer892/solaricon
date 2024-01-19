<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CategoryAttributeResource extends JsonResource
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
            'product_id' => $this->product_id,
            'attribute_id' => $this->attribute_id,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'product' => new ProductResource($this->whenLoaded('product')),
    'attribute' => new AttributeResource($this->whenLoaded('attribute')),
    
        ];
    }
}
