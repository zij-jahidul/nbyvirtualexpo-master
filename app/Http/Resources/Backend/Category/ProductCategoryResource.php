<?php

namespace App\Http\Resources\Backend\Category;

use Helper;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed company_id
 * @property mixed category_name
 * @property mixed cat_img
 * @property mixed status
 */
class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'company_id'    => $this->company_id,
            'category_name' => $this->category_name,
            'cat_img'       => Helper::publicUrl('frontend/assets/product-category/'.$this->cat_img),
            'image_path'   => '<img style="width:60px; height:60px;" src="'.Helper::publicUrl('frontend/assets/product-category/'.$this->cat_img).'">',
            'status'        => $this->status,
        ];
    }
}
