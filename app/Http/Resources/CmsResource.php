<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CmsResource extends JsonResource
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
            'id' => $this->id,
            'cms_type_id' => $this->cms_type_id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'content' => $this->content,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user' => UserResource::collection($this->whenLoaded('user')),
            'cmsType' => CmsTypeResource::collection($this->whenLoaded('cmsType')),

        ];
    }
}
