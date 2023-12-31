<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StorePersonalAccessTokenRequest extends BaseRequest
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
            "tokenable_type" => "required|max:180|min:3",

            "name" => "required|max:180|min:3",

            "token" => "required|max:180|min:3",

            "abilities" => "sometimes",

            "last_used_at" => "sometimes",

            "expires_at" => "sometimes",

        "token" => "exists:|required",

    ];
    }
}



