<?php

namespace App\Http\Resources\Backend\ProductCategory;
use Helper;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSubCategoryResource extends JsonResource
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
            'id'                  => $this->id,
            'sub_category_name' => $this->sub_category_name,
            'product_category_id' => $this->product_category_id,
            'image_path'          => Helper::publicUrl('frontend/assets/productsubcategory-image/'.$this->sub_cat_img),
            'sub_cat_img'       => '<img style = "width: 120px;" src = "'.Helper::publicUrl('frontend/assets/productsubcategory-image/'.$this->sub_cat_img).'">',
            'status'              => $this->status
        ];
    }
}
