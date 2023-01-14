<?php

namespace App\Http\Resources\Backend\EventCategory;


use Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed event_category_id
 * @property mixed event_sub_category_name
 * @property mixed event_sub_cat_img
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 * @property mixed id
 */

class EventSubCategoryResource extends JsonResource
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
            'event_category_id'         => $this->event_category_id,
            'event_sub_category_name'   => $this->event_sub_category_name,
            'event_sub_cat_img'         => '<img style="width:60px;height:60px;" src="'.Helper::publicUrl('frontend/assets/event-sub-category/'.$this->event_sub_cat_img).'">',
            'image_path'                => Helper::publicUrl('frontend/assets/event-sub-category/'.$this->event_sub_cat_img),
            'stall'                     => $this->stall,
            'status'                    => $this->status,
            'created_by'                => $this->created_by,
            'updated_by'                => $this->updated_by,
            'deleted_by'                => $this->deleted_by,
        ];
    }
}
