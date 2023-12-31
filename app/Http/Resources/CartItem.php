<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CartItem extends JsonResource
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
            'cart_id' => $this->cart_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'inline_total' => $this->inline_total,

            'product' => ProductResource::collection($this->whenLoaded('product')),
            'cart' => CartResource::collection($this->whenLoaded('cart')),

        ];
    }
}
