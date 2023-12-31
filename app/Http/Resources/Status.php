<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Status extends JsonResource
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
            'object' => $this->object,
            'name' => $this->name,
            'handler' => $this->handler,
            'is_active' => $this->is_active,

            'users' => UserResource::collection($this->whenLoaded('users')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),

        ];
    }
}
