<?php

namespace App\Models\ShippingAddress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class ShippingAddress extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'shipping_addresses';

}
