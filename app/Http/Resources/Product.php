<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Product extends JsonResource
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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'product_type_id' => $this->product_type_id,
            'name' => $this->name,
            'description' => $this->description,
            'purchase' => $this->purchase,
            'sale' => $this->sale,
            'stock' => $this->stock,

            'productType' => ProductTypeResource::collection($this->whenLoaded('productType')),
            'category' => CategoryResource::collection($this->whenLoaded('category')),
            'brand' => BrandResource::collection($this->whenLoaded('brand')),
            'productAttributes' => ProductAttributeResource::collection($this->whenLoaded('productAttributes')),
            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'categoryAttributes' => CategoryAttributeResource::collection($this->whenLoaded('categoryAttributes')),
            'cartItems' => CartItemResource::collection($this->whenLoaded('cartItems')),

        ];
    }
}
