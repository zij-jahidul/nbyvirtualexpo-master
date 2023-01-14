<?php

namespace App\Http\Resources\Backend\VendorSiteVisitor;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorSiteVisitorResource extends JsonResource
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
