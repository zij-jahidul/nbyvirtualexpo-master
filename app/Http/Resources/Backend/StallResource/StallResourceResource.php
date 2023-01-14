<?php

namespace App\Http\Resources\Backend\StallResource;

use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

/**
 * @property mixed name
 * @property mixed resource_file_name
 */
class StallResourceResource extends JsonResource
{

    /**
     * @param  $request
     * @return array
     */
    public function toArray($request):array
    {
        $headers = array('Content-Type: application/pdf',);
        return [
            'id'                    => $this->id,
            'stall_id'              => $this->stall_id,
            'name'                  => $this->name,
            'resource_file_name'    =>'<a href="'.url('/download-resource').'/'.$this->id.'">Download</a>',
           // 'resource_file_name'    =>'<a href="'.Helper::publicUrl('frontend/assets/resource').'/'.$this->resource_file_name.'" download>Download</a>',
        ];
    }
}
