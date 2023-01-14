<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'event_sub_category_id',
        'company_name',
        'company_img',
        'company_description',
        'company_expire_date',
        'status',
    ];
}
