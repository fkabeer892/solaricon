<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class Cms extends JsonResource
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
            'cms_type_id' => $this->cms_type_id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'content' => $this->content,
            'email' => $this->email,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'cmsType' => CmsTypeResource::collection($this->whenLoaded('cmsType')),

        ];
    }
}
