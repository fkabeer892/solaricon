<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreCmsRequest extends BaseRequest
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

            "content" => "required",

            "email" => "sometimes|email|unique:cms|max:180|min:3",

        "user_id" => "exists:users|required",

            "cms_type_id" => "exists:cms_types|required",

    ];
    }
}



