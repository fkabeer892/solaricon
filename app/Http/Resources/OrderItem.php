<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderItem extends JsonResource
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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'product_name' => $this->product_name,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'inline_total' => $this->inline_total,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'product' => ProductResource::collection($this->whenLoaded('product')),
            'order' => OrderResource::collection($this->whenLoaded('order')),

        ];
    }
}
