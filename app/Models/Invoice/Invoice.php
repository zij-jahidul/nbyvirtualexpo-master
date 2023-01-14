<?php

namespace App\Models\Invoice;

use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $invoice)
 * @method static where(string $string, $id)
 */
class Invoice extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
