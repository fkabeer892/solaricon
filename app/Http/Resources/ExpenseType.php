<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ExpenseType extends JsonResource
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
            'is_repeating' => $this->is_repeating,
            'frequency' => $this->frequency,
            'amount' => $this->amount,

            'expenses' => ExpenseResource::collection($this->whenLoaded('expenses')),

        ];
    }
}
