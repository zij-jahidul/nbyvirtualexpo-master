<?php

namespace App\Models\ProductCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed company_id
 * @property mixed category_name
 * @property mixed cat_img
 * @property mixed status
 * @method static latest()
 * @method static findOrFail(int $id)
 */
class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'cat_img',
        'company_id',
        'status'
    ];
}
