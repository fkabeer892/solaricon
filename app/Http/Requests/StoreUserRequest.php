<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreUserRequest extends BaseRequest
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

            "email" => "required|email|unique:users|max:180|min:3",

            "mobile" => "required|max:180|min:3",

            "email_verified_at" => "sometimes|email|unique:users",

            "password" => "required|max:180|min:3",

            "remember_token" => "sometimes|max:180|min:3",

        "status_id" => "exists:statuses|required",

            "role_id" => "exists:roles|required",

            "contact_id" => "exists:contacts|sometimes",

            "branch_id" => "exists:branches|sometimes",



    ];
    }
}



