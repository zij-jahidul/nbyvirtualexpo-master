<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'speaker',
        'meet_pass',
        'schedule_type',
        'topic',
        'description',
        'recurrance',
        'day_dt',
        'repeat_every',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'd_hour',
        'd_min',
        'class_date_end_time',
        'type',
        'meeting_id',
        'total_meeting',
        'host_id',
        'start_url',
        'join_url',
        'cancel_status',
        'timezone',
    ];

    public function webinarUser()
    {
        return $this->hasMany(WebinarUser::class);
    }
}

