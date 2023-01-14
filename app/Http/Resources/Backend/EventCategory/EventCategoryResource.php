<?php

namespace App\Http\Resources\Backend\EventCategory;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed id
 * @property mixed event_category_name
 * @property mixed event_cat_img
 * @property mixed status
 * @property mixed created_at
 * @property mixed updated_at
 */

class EventCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.

     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                  => $this->id,
            'event_category_name' => $this->event_category_name,
            'image_path'          => Helper::publicUrl('frontend/assets/event-category/'.$this->event_cat_img),
            'event_cat_img'       => '<img style = "width: 120px;" src = "'.Helper::publicUrl('frontend/assets/event-category/'.$this->event_cat_img).'">',
            'status'              => $this->status,
            'event_sub_category' => $this->eventSubCategory
        ];
    }
}
