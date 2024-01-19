<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderItemResource extends JsonResource
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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'product_name' => $this->product_name,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'inline_total' => $this->inline_total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'user' => new UserResource($this->whenLoaded('user')),
    'product' => new ProductResource($this->whenLoaded('product')),
    'order' => new OrderResource($this->whenLoaded('order')),
    
        ];
    }
}
