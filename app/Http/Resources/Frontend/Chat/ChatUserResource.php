<?php

namespace App\Http\Resources\Frontend\Chat;

use Helper;
use App\Models\ChatUser;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $activity = ChatUser::where('user_id', $this->id)->first()->online_status??'';
       
        return [
            'id'    => $this->id, 
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role'  => $this->role,
            'stall_id' => ChatUser::where('user_id', $this->id)->first()->stall_id??'',
            'activity_status' => $activity == 0? 'offline':($activity == 1?'online':($activity == 2?'busy':'free')),
            'activity_class' => $activity == 0? 'bg-default':($activity == 1?'bg-success':($activity == 2?'bg-warning':'bg-primary')),
            'photo' => Helper::publicUrl('images/user/'.$this->photo),
            'photo_path' => '<img style="width:60px;height:60px;" src="'.Helper::publicUrl('images/user/'.$this->photo).'" >'

        ];
    }
}
