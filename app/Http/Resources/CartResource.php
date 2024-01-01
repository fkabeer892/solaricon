<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CartResource extends JsonResource
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
            'user_id' => $this->user_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'cartItems' => CartItemResource::collection($this->whenLoaded('cartItems')),

        ];
    }
}
