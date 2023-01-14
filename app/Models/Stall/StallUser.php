<?php

namespace App\Models\Stall;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'stall_id',
        'activity_status',
        'status',
    ];

    
}
