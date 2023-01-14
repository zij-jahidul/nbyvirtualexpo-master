<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory\ProductSubCategory;
class ProductSubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productSubCategory = array(
            [
                'product_category_id'=>'1',
                'company_id'=>'1',
                'sub_category_name'=>'Basic Tv',
                'sub_cat_img'=>'DemoCat.png',
            ],
            [
                'product_category_id'=>'1',
                'company_id'=>'1',
                'sub_category_name'=>'Led Tv',
                'sub_cat_img'=>'DemoCat.png',
            ],
            [
                'product_category_id'=>'2',
                'company_id'=>'2',
                'sub_category_name'=>'Basic Tv',
                'sub_cat_img'=>'DemoCat.png',
            ],
            [
                'product_category_id'=>'2',
                'company_id'=>'2',
                'sub_category_name'=>'Led Tv',
                'sub_cat_img'=>'DemoCat.png',
            ],
            
        );
        ProductSubCategory::insert($productSubCategory);
    }
}
