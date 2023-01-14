<?php

namespace App\Http\Resources\Frontend\StallResoruce;

use Illuminate\Http\Resources\Json\JsonResource;

class StallResourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param    $request
     * @return array
     */
    public function toArray($request):array
    {
        return [
            'id'                    => $this->id,
            'stall_id'              => $this->stall_id,
            'name'                  => $this->name,
            'resource_file_name'    =>url('/download-resource').'/'.$this->id,
            'resource_file_name'    =>url('/download-resource').'/'.$this->id,
            // 'resource_file_name'    =>'<a href="'.Helper::publicUrl('frontend/assets/resource').'/'.$this->resource_file_name.'" download>Download</a>',
        ];
    }
}
