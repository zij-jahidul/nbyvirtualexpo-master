<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpdeskChatUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'user_id',
        'helpdesk_room_id',
        'user_name',
        'user_photo',
        'message_class',
        'online_status',
    ];
}
