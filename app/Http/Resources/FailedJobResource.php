<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class FailedJobResource extends JsonResource
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
            'uuid' => $this->uuid,
            'connection' => $this->connection,
            'queue' => $this->queue,
            'payload' => $this->payload,
            'exception' => $this->exception,
            'failed_at' => $this->failed_at,

    'branch' => new BranchResource($this->whenLoaded('branch')),
    
        ];
    }
}
