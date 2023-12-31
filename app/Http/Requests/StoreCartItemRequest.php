<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreCartItemRequest extends BaseRequest
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
            "product_name" => "required|max:180|min:3",

            "quantity" => "required",

            "price" => "required|min:0",

            "discount" => "required|min:0",

            "inline_total" => "sometimes|min:0",

        "product_id" => "exists:products|required",

            "cart_id" => "exists:carts|required",

    ];
    }
}



