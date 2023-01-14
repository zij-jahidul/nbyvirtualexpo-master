<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'stall_id',
        'receiver_id',
        'user_id',
        'user_name',
        'user_photo',
        'message_class',
        'online_status',
        'chat_room_id',
    ];
}
