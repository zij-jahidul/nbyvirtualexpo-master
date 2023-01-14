<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($order_product_data)
 */
class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
}
