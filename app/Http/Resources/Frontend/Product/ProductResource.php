<?php

namespace App\Http\Resources\Frontend\Product;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed image
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'stall_id' => $this->stall_id,
            'company_id' => $this->company_id,
            'product_category_id' => $this->product_category_id,
            'product_sub_category_id' => $this->product_sub_category_id,
            'product_name' => $this->product_name,
            'product_code' => $this->product_code,
            'product_img' => $this->product_img,
            'color' => $this->color,
            'size' => $this->size,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'wholesale_price' => $this->wholesale_price,
            'offer_price' => $this->offer_price,
            'description' => $this->description,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'image' => $this->image->pluck('image'),
            'category' => $this->category->category_name,
            'subCategory' => $this->subCategory->sub_category_name,
            'stall' => $this->stall->pluck('id', 'stall_name', 'company_id', 'close_time','open_time', 'brand_name'),
            // 'brand_name' => $this->brand_name,

        ];

    }
}
