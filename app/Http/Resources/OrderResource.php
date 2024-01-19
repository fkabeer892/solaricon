<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class OrderResource extends JsonResource
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
            'cart_id' => $this->cart_id,
            'order_number' => $this->order_number,
            'payment_address_id' => $this->payment_address_id,
            'shipping_address_id' => $this->shipping_address_id,
            'total' => $this->total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'user' => new UserResource($this->whenLoaded('user')),
    'status' => new StatusResource($this->whenLoaded('status')),
    'contact' => new ContactResource($this->whenLoaded('contact')),
    'cart' => new CartResource($this->whenLoaded('cart')),
        'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
   
        ];
    }
}
