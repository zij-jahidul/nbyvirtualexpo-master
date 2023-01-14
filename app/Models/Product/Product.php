<?php

namespace App\Models\Product;

use App\Models\ProductCategory\ProductCategory;
use App\Models\ProductCategory\ProductSubCategory;
use App\Models\Stall\Stall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed stall_id
 * @property mixed product_category_id
 * @property mixed product_sub_category_id
 * @property mixed product_name
 * @property mixed product_code
 * @property mixed product_img
 * @property mixed color
 * @property mixed size
 * @property mixed cost_price
 * @property mixed selling_price
 * @property mixed wholesale_price
 * @property mixed offer_price
 * @property mixed description
 * @property mixed status
 * @property mixed created_by
 * @method static latest()
 * @method static findOrFail(int $id)
 * @method static paginate(int $int)
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_sub_category_id');
    }
    public function stall()
    {
        return $this->belongsTo(Stall::class, 'stall_id');
    }
}
