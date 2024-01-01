<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class PersonalAccessTokenResource extends JsonResource
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
            'tokenable_type' => $this->tokenable_type,
            'tokenable_id' => $this->tokenable_id,
            'name' => $this->name,
            'token' => $this->token,
            'abilities' => $this->abilities,
            'last_used_at' => $this->last_used_at,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


        ];
    }
}
