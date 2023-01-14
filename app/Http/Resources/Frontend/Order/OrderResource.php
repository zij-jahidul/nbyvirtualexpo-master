<?php

namespace App\Http\Resources\Frontend\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        return[
            'id'                => $this->id,
            'amount'            => $this->amount,
            'customer_id'       => $this->customer_id,
            'order_details'     => $this->orderDetails,
            'order_number'      => $this->order_number,
            'order_status'      => $this->order_status,
            'quantity'          => $this->quantity,
            'shipping_address'  => $this->shippingAddress,
            'status'            => $this->status,
            'user'              => $this->user,
            'created_at'        => $this->created_at->toDayDateTimeString(),
            'shipping'          => $this->shipping,
            'invoice'           => $this->invoice
        ];
    }
}
