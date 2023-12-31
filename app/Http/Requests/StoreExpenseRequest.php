<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreExpenseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            "name" => "required|max:180|min:3",

            "amount" => "required|min:0",

        "status_id" => "exists:statuses|required",

            "expense_type_id" => "exists:expense_types|required",

            "branch_id" => "exists:branches|sometimes",

    ];
    }
}



