<?php

namespace App\Http\Resources\Backend\Visitor;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitorPointResource extends JsonResource
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
            'visitor_point_distribution_id' => $this->visitor_point_distribution_id,
            'customer_id' => $this->customer_id,
        ];
    }
}
