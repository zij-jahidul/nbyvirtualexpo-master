<?php

namespace App\Models\ProductCategory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    // protected $guarded = [];

    protected $fillable = [
        'product_category_id',
        'company_id',
        'sub_category_name',
        'sub_cat_img',
        'status',
        'created_by',
        'updated_by'
    ];
}
