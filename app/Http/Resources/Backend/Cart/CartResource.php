<?php

namespace App\Http\Resources\Backend\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'stall_id' => $this->stall_id,
            'customer_id' => $this->cusomer_id,
        ];
    }
}
