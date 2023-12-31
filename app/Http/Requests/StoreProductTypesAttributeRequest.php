<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreProductTypesAttributeRequest extends BaseRequest
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
        "product_type_id" => "exists:product_types|required",

            "attribute_id" => "exists:attributes|required",

    ];
    }
}



