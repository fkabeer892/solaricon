<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreFailedJobRequest extends BaseRequest
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
            "uuid" => "required|max:180|min:3",

            "connection" => "required",

            "queue" => "required",

            "payload" => "required",

            "exception" => "required",

            "failed_at" => "required",

        "uuid" => "exists:|required",

    ];
    }
}



