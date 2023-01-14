<?php

namespace App\Models\Order;

use App\Models\Invoice\Invoice;
use App\Models\ShippingAddress\ShippingAddress;
use App\Models\Stall\Stall;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $order_data)
 * @method static where(string $string, $id)
 * @method static findOrFail(int $id)
 * @method static orderBy(string $string, string $string1)
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderDetails(): HasMany
    {
       return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function shipping()
    {
        return $this->belongsTo(ShippingAddress::class, 'shipping_address_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function stall()
    {
       return $this->belongsTo(Stall::class);
    }


}
