<?php

namespace App\Http\Resources\Backend\Company;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed company_name
 * @property mixed company_img
 * @property mixed company_description
 * @property mixed company_expire_date
 * @property mixed status
 * @property mixed created_at
 * @property mixed updated_at
 */
class CompanyResource extends JsonResource
{
    /**
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
                'id'                  => $this->id,
                'company_name'        => $this->company_name,
                'company_img'         => '<img style = "width: 60px;height: 60px;" src = "'.Helper::publicUrl('frontend/assets/company/'.$this->company_img).'">',
                'image_path'          => Helper:: publicUrl('frontend/assets/company/'.$this->company_img),
                'event_sub_category_id' => $this->event_sub_category_id,
                'company_description' => $this->company_description,
                'company_expire_date' => $this->company_expire_date,
                'status'              => $this->status
        ];
    }

}
