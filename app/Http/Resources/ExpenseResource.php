<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ExpenseResource extends JsonResource
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
            'expense_type_id' => $this->expense_type_id,
            'branch_id' => $this->branch_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'status' => new StatusResource($this->whenLoaded('status')),
    'expenseType' => new ExpenseTypeResource($this->whenLoaded('expenseType')),
    'branch' => new BranchResource($this->whenLoaded('branch')),
    
        ];
    }
}
