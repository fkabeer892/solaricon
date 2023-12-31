<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ProductType extends JsonResource
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

            'productTypesAttributes' => ProductTypesAttributeResource::collection($this->whenLoaded('productTypesAttributes')),
            'products' => ProductResource::collection($this->whenLoaded('products')),

        ];
    }
}
