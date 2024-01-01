<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductTypeResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'productTypesAttributes' => ProductTypesAttributeResource::collection($this->whenLoaded('productTypesAttributes')),
            'products' => ProductResource::collection($this->whenLoaded('products')),

        ];
    }
}
