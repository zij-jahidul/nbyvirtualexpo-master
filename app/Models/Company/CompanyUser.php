<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class CompanyUser extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'user_id'];
}
