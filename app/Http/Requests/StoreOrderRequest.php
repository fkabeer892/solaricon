<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreOrderRequest extends BaseRequest
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
            "order_number" => "required|max:180|min:3",

            "total" => "required|min:0",

            "discount" => "required|min:0",

            "grand_total" => "required|min:0",

        "user_id" => "exists:users|required",

            "status_id" => "exists:statuses|required",

            "payment_address_id" => "exists:contacts|sometimes",

            "cart_id" => "exists:carts|required",

    ];
    }
}



