<?php

namespace App\Http\Resources\Backend\MultiMedia;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaBlogResource extends JsonResource
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
            'company_id' => $this->company_id,
            // 'company_name' => $this->companyName['company_name'],
            'user_id' => $this->user_id,
            // 'user_name' => $this->userName['name'],
            'event_categorie_id' => $this->event_categorie_id,
            // 'event_categorie_name' => $this->eventCategoryName['event_category_name'],
            'blog_title' => $this->blog_title,
            'blog_tropic' => $this->blog_tropic,
            'blog_img' => $this->blog_img,
            'blog_live_broadcust' => $this->blog_live_broadcust,
            'blog_description' => $this->blog_description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
