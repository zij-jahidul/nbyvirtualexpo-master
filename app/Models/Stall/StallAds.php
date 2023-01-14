<?php

namespace App\Models\Stall;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StallAds extends Model
{
    use HasFactory;
    protected $fillable = [
                    'id',
            'stall_id',
            'ads',
            'ads_type',
            'ads_position',
            'image',
            'video_link',
            'status',
            'created_by',
            'updated_by',
            'deleted_by',
            
    ];

}
