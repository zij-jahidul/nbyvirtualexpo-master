<?php

namespace App\Http\Resources\Backend\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVisitorResource extends JsonResource
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
            'product_id' => $this->product_id,
            'customer_id' => $this->customer_id,
        ];
    }
}
