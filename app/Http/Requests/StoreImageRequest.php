<?php 

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreImageRequest extends BaseRequest
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

            "object_type" => "required|max:180|min:3",

            "file_name" => "required|max:180|min:3",

];
    }
}



