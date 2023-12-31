<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Branch extends JsonResource
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
            'name' => $this->name,
            'contact_id' => $this->contact_id,

            'contact' => ContactResource::collection($this->whenLoaded('contact')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),

        ];
    }
}
