<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Category extends JsonResource
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
            'parent_id' => $this->parent_id,
            'name' => $this->name,

            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            'products' => ProductResource::collection($this->whenLoaded('products')),

        ];
    }
}
