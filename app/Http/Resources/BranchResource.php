<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class BranchResource extends JsonResource
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
            'name' => $this->name,
            'contact_id' => $this->contact_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'contact' => new ContactResource($this->whenLoaded('contact')),
        'users' => UserResource::collection($this->whenLoaded('users')),
   'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),
   
        ];
    }
}
