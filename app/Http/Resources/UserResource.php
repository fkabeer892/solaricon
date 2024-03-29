<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return  array
     */
    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'contact_id' => $this->contact_id,
            'role_id' => $this->role_id,
            'status_id' => $this->status_id,
            'branch_id' => $this->branch_id,

            'userRoles' => UserRoleResource::collection($this->whenLoaded('userRoles')),
            'orderItems' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
            'cms' => CmsResource::collection($this->whenLoaded('cms')),
            'carts' => CartResource::collection($this->whenLoaded('carts')),
            'status' => new StatusResource($this->whenLoaded('status')),
            'role' => new RoleResource($this->whenLoaded('role')),
            'contact' => new ContactResource($this->whenLoaded('contact')),
            'branch' => new BranchResource($this->whenLoaded('branch')),


        ];
    }
}
