<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Brand extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function toArray($request)
    {


        return [
            'name' => $this->name,

            'products' => ProductResource::collection($this->whenLoaded('products')),

        ];
    }
}
