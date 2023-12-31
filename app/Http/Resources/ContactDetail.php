<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ContactDetail extends JsonResource
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
            'contact_id' => $this->contact_id,
            'contact_key' => $this->contact_key,
            'contact_value' => $this->contact_value,

            'contact' => ContactResource::collection($this->whenLoaded('contact')),

        ];
    }
}
