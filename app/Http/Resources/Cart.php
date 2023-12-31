<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Cart extends JsonResource
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
            'user_id' => $this->user_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'cartItems' => CartItemResource::collection($this->whenLoaded('cartItems')),

        ];
    }
}
