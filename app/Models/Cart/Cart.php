<?php

namespace App\Models\Cart;

use App\Models\Product\Product;
use App\Models\Stall\Stall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 * @method static findOrFail(int $id)
 * @method static where(string $string, $id)
 */
class Cart extends Model
{
    use HasFactory;

    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function stall()
    {
        return $this->belongsTo(Stall::class, 'stall_id');
    }
}
