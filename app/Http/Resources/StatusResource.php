<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class StatusResource extends JsonResource
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
            'object' => $this->object,
            'name' => $this->name,
            'handler' => $this->handler,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'users' => UserResource::collection($this->whenLoaded('users')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),

        ];
    }
}
