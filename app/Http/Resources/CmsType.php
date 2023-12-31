<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CmsType extends JsonResource
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

            'cms' => CmsResource::collection($this->whenLoaded('cms')),

        ];
    }
}
