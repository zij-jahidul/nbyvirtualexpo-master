<?php

namespace App\Http\Resources\Backend\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'stall_id' => $this->stall_id,
            'order_number' => $this->order_number,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'shipping_address' => $this->shipping_address,
            'shipping' => $this->shipping,
            'order_status_rendered' => $this->order_status == 1?'Pending':($this->order_status == 2?'Processing':($this->order_status==3?'Delivered':'Completed')),
            'order_status' => $this->order_status,
            'status' => $this->status,
            'created_at' => $this->created_at->toDayDateTimeString(),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'user' => $this->user,
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'order_details' => $this->orderDetails,
            'show_btn' => '<a href="'.url('/admin').'/order/'. $this->id.'"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button></a> ',
        ];
    }
}
