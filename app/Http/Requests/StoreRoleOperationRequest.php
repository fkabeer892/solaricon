<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreRoleOperationRequest extends BaseRequest
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
            "access_level" => "required|max:180|min:3",

        "role_id" => "exists:roles|required",

            "operation_id" => "exists:operations|required",

    ];
    }
}



