<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class PasswordResetTokenResource extends JsonResource
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
            'email' => $this->email,
            'token' => $this->token,
            'created_at' => $this->created_at,


        ];
    }
}
