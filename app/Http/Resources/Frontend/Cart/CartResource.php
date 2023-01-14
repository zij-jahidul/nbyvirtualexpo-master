<?php

namespace App\Http\Resources\Frontend\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed stall_id
 * @property mixed quantity
 * @property mixed product_id
 * @property mixed customer_id
 * @property mixed product
 * @property mixed company_id
 * @property mixed stall
 */
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param    $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'stall_id' => $this->stall_id,
            'quantity' => $this->quantity,
            'product_id' => $this->product_id,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'product' => $this->product,
            'stall' => $this->stall,

        ];

    }
}
