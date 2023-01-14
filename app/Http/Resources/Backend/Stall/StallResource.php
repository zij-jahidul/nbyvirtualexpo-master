<?php

namespace App\Http\Resources\Backend\Stall;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed company_id
 * @property mixed stall_layout_id
 * @property mixed event_sub_category_id
 * @property mixed stall_name
 * @property mixed brand_name
 * @property mixed manufacturer_name
 * @property mixed open_time
 * @property mixed close_time
 * @property mixed stall_brochure
 * @property mixed stall_description
 * @property mixed stall_live_boardcust
 * @property mixed stall_announcement
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 * @property mixed id
 */

class StallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param   $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                    =>$this->id,
            'company_id'            =>$this->company_id,
            'stall_layout_id'       =>$this->stall_layout_id,
            'event_sub_category_id' =>$this->event_sub_category_id,
            'stall_name'            =>$this->stall_name,
            'brand_name'            =>$this->brand_name,
            'manufacturer_name'     =>$this->manufacturer_name,
            'open_time'             =>$this->open_time,
            'close_time'            =>$this->close_time,
            'stall_brochure'        =>$this->stall_brochure,
            'stall_description'     =>$this->stall_description,
            'stall_live_boardcust'  =>$this->stall_live_boardcust,
            'stall_announcement'    =>$this->stall_announcement,
            'status'                =>$this->status,
            'created_by'            =>$this->created_by,
            'updated_by'            =>$this->updated_by,
            'deleted_by'            =>$this->deleted_by,
            'company_logo'          =>$this->company->company_img,
            'stall_ads'             =>$this->stallAds,
            'stalllayout'           =>$this->stalllayout->layout_img,
            'statusIndex'           =>$this->status==1?'Active':'Inactive',
        ];
    }
}
