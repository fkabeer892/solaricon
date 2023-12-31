<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreContactDetailRequest extends BaseRequest
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
            "contact_key" => "required|max:180|min:3",

            "contact_value" => "required|max:180|min:3",

        "contact_id" => "exists:contacts|required",

    ];
    }
}



