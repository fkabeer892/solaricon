<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreProductRequest extends BaseRequest
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

            "description" => "sometimes",

            "purchase" => "sometimes|min:0",

            "sale" => "sometimes|min:0",

            "stock" => "sometimes",

        "product_type_id" => "exists:product_types|required",

            "category_id" => "exists:categories|required",

            "brand_id" => "exists:brands|required",

    ];
    }
}



