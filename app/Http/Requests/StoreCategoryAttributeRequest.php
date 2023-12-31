<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreCategoryAttributeRequest extends BaseRequest
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
            "value" => "required|max:180|min:3",

        "product_id" => "exists:products|required",

            "attribute_id" => "exists:attributes|required",

    ];
    }
}



