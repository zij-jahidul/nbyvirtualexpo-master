<?php

namespace App\Http\Resources\Backend\Stall;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class StallAdsResource extends JsonResource
{
    /**
     * Transform the resource into an array.,,
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'ads_type'       => $this->ads_type,
            'adsTypeText'    => $this->ads_type == 1?'Video':'Image',
            'ads_position'   => $this->ads_position,

           'adsPositionText' => $this->ads_position == 1? 'Center':($this->ads_position == 2? 'Sponsor':($this->ads_position == 3?'Right Small':($this->ads_position == 4?'Right Big':($this->ads_position == 5?'Left Small':'Left Big')))),
           
            'video_link'     => $this->video_link,
            'status'         => $this->status,
            'statusText'     => $this->status == 1?'Active':'Inactive',
            'imageOrVideo' => $this->image?'haveImage':'haveVideo',
          
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,

            'image'          => Helper::publicUrl('/').'/'.'images/StallAds/'.$this->image,
            'image_path'     => ' <img style="width:60px; height:60px;" class="img-fluid" src="'.Helper::publicUrl('/').'/'.'images/StallAds/'.$this->image.'">',
           
        ];
    }
}
