<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreCartRequest extends BaseRequest
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
            "total" => "required|min:0",

            "discount" => "required|min:0",

            "grand_total" => "required|min:0",

        "user_id" => "exists:users|required",

    ];
    }
}



