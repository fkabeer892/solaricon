<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreContactRequest extends BaseRequest
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
            "address" => "required|max:180|min:3",

            "area" => "required|max:180|min:3",

            "city" => "required|max:180|min:3",

            "state" => "required|max:180|min:3",

            "country" => "required|max:180|min:3",

            "mobile" => "required|max:180|min:3",

            "phone" => "sometimes|max:180|min:3",

            "latitude" => "sometimes|min:0",

            "longitude" => "sometimes|min:0",

        "user_id" => "exists:users|sometimes",

    ];
    }
}



