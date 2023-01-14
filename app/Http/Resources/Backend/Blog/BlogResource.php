<?php

namespace App\Http\Resources\Backend\Blog;

use Carbon\Carbon;
use Helper;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed id
 * @property mixed company_id
 * @property mixed user_id
 * @property mixed event_category_id
 * @property mixed title
 * @property mixed tropic
 * @property mixed feature_image
 * @property mixed live_broadcust
 * @property mixed description
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 */

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.

     * @param   $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'company_id'        => $this->company_id,
            'user_id'           => $this->user_id,
            'slug'              => $this->slug,
            'event_category_id' => $this->event_category_id,
            'title'             => $this->title,
            'tropic'            => $this->tropic,
            'feature_image'     => $this->feature_image,
            'live_broadcust'    => $this->live_broadcust,
            'description'       => $this->description,
            'status'            => $this->status,
            'created_by'        => $this->created_by,
            'updated_by'        => $this->updated_by,
            'deleted_by'        => $this->deleted_by,
            'feature_image'     => Helper::publicUrl('/').'/'.'images/blog/'.$this->feature_image,
            'image_path'        => '<img style="width:60px; height:60px;" class="img-fluid" src="'.Helper::publicUrl('/').'/'.'images/blog/'.$this->feature_image.'">',
            'user'              => $this->user,
            'created_month'         => Carbon::parse($this->created_at)->format('M'),
            'created_day'         => Carbon::parse($this->created_at)->format('d'),
            'created_date'         => Carbon::parse($this->created_at)->format('d/M/Y'),
                                       
           
        ];

    }
}
