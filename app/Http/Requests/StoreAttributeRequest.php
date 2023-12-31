<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreAttributeRequest extends BaseRequest
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

            "type" => "sometimes|max:180|min:3",

            "handler" => "sometimes|max:180|min:3",

            "default" => "sometimes|max:180|min:3",

];
    }
}



