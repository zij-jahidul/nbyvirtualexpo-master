<?php

namespace App\Http\Resources\Backend\Webinar;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarResource extends JsonResource
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
            'id'                  => $this->id,
            'speakers'             => $this->webinarUser,
            'meet_pass'           => $this->meet_pass,
            'schedule_type'       => $this->schedule_type,
            'topic'               => $this->topic,
            'description'         => $this->description,
            'recurrance'          => $this->recurrance,
            'day_dt'              => $this->day_dt,
            'repeat_every'        => $this->repeat_every,
            'start_date'          => $this->start_date,
            'end_date'            => $this->end_date,
            'upcoming'            => $this->start_date >= Carbon::now()->format('Y-m-d')?'yes':'no',  
            'start_time'          => Carbon::parse($this->start_time)->format('g:i A'),
            'end_time'            => Carbon::parse($this->end_time)->format('g:i A'),
            // 'duration'            => Carbon::parse($this->end)
            'd_hour'              => $this->d_hour,
            'd_min'               => $this->d_min,
            'class_date_end_time' => $this->class_date_end_time,
            'type'                => $this->type,
            'meeting_id'          => $this->meeting_id,
            'total_meeting'       => $this->total_meeting,
            'host_id'             => $this->host_id,
            'start_url'           => $this->start_url,
            'join_url'            => $this->join_url,
            'cancel_status'       => $this->cancel_status,
            'timezone'            => $this->timezone,
        ];
    }
}
