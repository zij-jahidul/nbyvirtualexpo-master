<?php

namespace App\Http\Resources\Backend\Webinar;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarUserResource extends JsonResource
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
            'webinar_id' => $this->webinar_id,
            'name' => $this->name,
            'designation' => $this->designation,
            // 'image'   => $this->image,
           'image_path'=>' <img style="width:60px; height:60px;" class="img-fluid" src="'.Helper::publicUrl('/').'/'.'images/webinarUser/'.$this->image.'">',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'image'     => Helper::publicUrl('/').'/'.'images/webinarUser/'.$this->image,

            // 'image_path'        => '<img style="width:60px; height:60px;" class="img-fluid" src="'.Helper::publicUrl('/').'/'.'images/blog/'.$this->feature_image.'">',

        ];
    }
}
