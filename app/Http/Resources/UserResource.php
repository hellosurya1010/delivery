<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            "id" => $this->id, 
            "first_name" => $this->first_name, 
            "last_name" => $this->last_name, 
            "phone" => $this->phone, 
            "email" => $this->email, 
            "role" => $this->role, 
            "profile_picture" => $this->profile_picture, 
        ];
        return $data;
    }
}
