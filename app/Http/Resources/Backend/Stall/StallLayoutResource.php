<?php

namespace App\Http\Resources\Backend\Stall;


use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed event_sub_category_id
 * @property mixed layout_name
 * @property mixed layout_img
 * @property mixed layout_color
 * @property mixed layout_size
 * @property mixed layout_description
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 */

class StallLayoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param    $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                        => $this->id,
            'company_id'                => $this->company_id,
            'event_sub_category_id'     => $this->event_sub_category_id,
            'layout_name'               => $this->layout_name,
            'layout_img'                => '<img style = "width: 60px;height: 60px;" src = "'.Helper::publicUrl('images/uploads/stall/'.$this->layout_img).'">',
            'layout_image'              => $this->layout_img,
            'image_path'                => Helper:: publicUrl('images/uploads/stall/'.$this->layout_img),
            'layout_color'              => $this->layout_color,
            'layout_size'               => $this->layout_size,
            'layout_description'        => $this->layout_description,
            'status'                    => $this->status,
            'created_by'                => $this->created_by,
            'updated_by'                => $this->updated_by,
            'deleted_by'                => $this->deleted_by,
        ];
    }
}
