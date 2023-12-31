<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Order extends JsonResource
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
            'cart_id' => $this->cart_id,
            'order_number' => $this->order_number,
            'payment_address_id' => $this->payment_address_id,
            'shipping_address_id' => $this->shipping_address_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'status_id' => $this->status_id,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'status' => StatuResource::collection($this->whenLoaded('status')),
            'contact' => ContactResource::collection($this->whenLoaded('contact')),
            'cart' => CartResource::collection($this->whenLoaded('cart')),
            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),

        ];
    }
}
