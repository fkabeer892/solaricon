<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class FailedJob extends JsonResource
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
            'uuid' => $this->uuid,
            'connection' => $this->connection,
            'queue' => $this->queue,
            'payload' => $this->payload,
            'exception' => $this->exception,
            'failed_at' => $this->failed_at,

            'branche' => BrancheResource::collection($this->whenLoaded('branche')),

        ];
    }
}
