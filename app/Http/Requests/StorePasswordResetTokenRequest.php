<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StorePasswordResetTokenRequest extends BaseRequest
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
            "email" => "required|email|unique:password_reset_tokens|max:180|min:3",

            "token" => "required|max:180|min:3",

];
    }
}



