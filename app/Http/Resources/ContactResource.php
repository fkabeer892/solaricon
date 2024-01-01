<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ContactResource extends JsonResource
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
            'address' => $this->address,
            'area' => $this->area,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'users' => UserResource::collection($this->whenLoaded('users')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'contactDetail' => ContactDetailResource::collection($this->whenLoaded('contactDetail')),
            'branches' => BranchResource::collection($this->whenLoaded('branches')),

        ];
    }
}
