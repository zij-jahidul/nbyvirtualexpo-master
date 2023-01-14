<?php

namespace App\Http\Resources\Frontend\AllCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ESCResource extends JsonResource
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
            'id'                        => $this->id,
            'event_category_id'         => $this->event_category_id,
            'event_sub_category_name'   => $this->event_sub_category_name,
           
        ];
    }
}
