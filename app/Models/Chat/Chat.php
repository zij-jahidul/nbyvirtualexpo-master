<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_id',
        'stall_id',
        'user_id',
        'message',
        'chat_document',
        'chat_time',
        'message_class',
        'receiver_id',
        'user_name',
        'user_photo',
        'chat_room_id',
        'missed_call',

    ];
}
