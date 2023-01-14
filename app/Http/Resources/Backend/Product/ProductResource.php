<?php

namespace App\Http\Resources\Backend\Product;

use Helper;
use Illuminate\Http\Request;
use App\Models\Product\ProductImage;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed stall_id
 * @property mixed product_category_id
 * @property mixed product_sub_category_id
 * @property mixed product_name
 * @property mixed product_code
 * @property mixed product_img
 * @property mixed color
 * @property mixed size
 * @property mixed cost_price
 * @property mixed selling_price
 * @property mixed wholesale_price
 * @property mixed offer_price
 * @property mixed description
 * @property mixed status
 * @property mixed created_by
 * @property mixed updated_by
 * @property mixed deleted_by
 */

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *

     * @param    $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                      => $this->id,
            'stall_id'                => $this->stall_id,
            'product_category_id'     => $this->product_category_id,
            'product_sub_category_id' => $this->product_sub_category_id,
            'product_name'            => $this->product_name,
            'product_code'            => $this->product_code,
            'color'                   => $this->color,
            'size'                    => $this->size,
            'cost_price'              => $this->cost_price,
            'selling_price'           => $this->selling_price,
            'wholesale_price'         => $this->wholesale_price,
            'offer_price'             => $this->offer_price,
            'description'             => $this->description,
            'status'                  => $this->status,
            'created_by'              => $this->created_by,
            'updated_by'              => $this->updated_by,
            'deleted_by'              => $this->deleted_by,
            'images'                  => ProductImage::where('product_id', $this->id)->get(), //Helper::publicUrl('/').'/'.'frontend/assets/product-images/'.$this->product_img,
            'image_path'              => Helper::publicUrl('/').'/'.'frontend/assets/product-images/'.$this->product_img,// '<img style = "width: 60px; height: 60px;" src = "'.Helper::publicUrl('/').'/'.'frontend/assets/product-images/'.$this->product_img.'">',
            'feature_image'           => '<img style = "width: 60px; height: 60px;" src = "'.Helper::publicUrl('/').'/'.'frontend/assets/product-images/'.$this->product_img.'">',

        ];

    }
}
