<?php

namespace App\Models\Webinar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'webinar_id',
        'name',
        'designation',
        'image',
        'status',
    ];
}
