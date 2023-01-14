<?php

namespace App\Http\Resources\Backend\Stall;

use Helper;
use App\Models\Stall\StallUser;
use Illuminate\Http\Resources\Json\JsonResource;

class StallUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $activity = StallUser::where('user_id', $this->id)->first()->activity_status??'';
       
        return [
            'id'    => $this->id, 
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role'  => $this->role,
            'stall_id' => StallUser::where('user_id', $this->id)->first()->stall_id??'',
            'activity_status' => $activity == 0? 'offline':($activity == 1?'online':($activity == 2?'busy':'free')),
            'activity_class' => $activity == 0? 'bg-default':($activity == 1?'bg-success':($activity == 2?'bg-warning':'bg-primary')),
            'photo' => Helper::publicUrl('images/user/'.$this->photo),
            'photo_path' => '<img style="width:60px;height:60px;" src="'.Helper::publicUrl('images/user/'.$this->photo).'" >'

        ];
    }
}
