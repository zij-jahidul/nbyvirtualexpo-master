<?php

namespace App\Models\District;

use App\Models\Stall\Stall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public function stall()
    {
        return $this->belongsToMany(Stall::class);
    }
}
