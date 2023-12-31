<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Expense extends JsonResource
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
            'expense_type_id' => $this->expense_type_id,
            'branch_id' => $this->branch_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'status_id' => $this->status_id,

            'status' => StatuResource::collection($this->whenLoaded('status')),
            'expenseType' => ExpenseTypeResource::collection($this->whenLoaded('expenseType')),
            'branch' => BranchResource::collection($this->whenLoaded('branch')),

        ];
    }
}
