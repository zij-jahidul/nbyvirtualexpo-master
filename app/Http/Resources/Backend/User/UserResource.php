<?php

namespace App\Http\Resources\Backend\User;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id, 
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role'  => $this->role, 
            'photo' => Helper::publicUrl('images/user/'.$this->photo),
            'photo_path' => '<img style="width:60px;height:60px;" src="'.Helper::publicUrl('images/user/'.$this->photo).'" >'

        ];
    }
}
