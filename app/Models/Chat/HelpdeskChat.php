<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpdeskChat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'helpdesk_room_id',
        'message',
        'chat_document',
        'chat_time',
        'message_class',
        'receiver_id',
        'user_name',
        'user_photo',
        'message_reading',
    ];
}
