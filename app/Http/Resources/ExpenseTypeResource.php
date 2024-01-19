<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ExpenseTypeResource extends JsonResource
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
            'is_repeating' => $this->is_repeating,
            'frequency' => $this->frequency,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),
   
        ];
    }
}
