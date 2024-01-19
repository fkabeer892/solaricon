<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class ContactDetailResource extends JsonResource
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
            'contact_id' => $this->contact_id,
            'contact_key' => $this->contact_key,
            'contact_value' => $this->contact_value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

    'contact' => new ContactResource($this->whenLoaded('contact')),
    
        ];
    }
}
