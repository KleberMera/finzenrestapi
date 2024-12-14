<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rol_id' => $this->rol_id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'user' => $this->user,
            'email' => $this->email,  
            'phone' => $this->phone,
            'status' => $this->status,
        ];
    }
}
