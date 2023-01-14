<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory\ProductCategory;
class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productCategory = array(
            [
                'company_id'=>'1',
                'category_name'=>'Smart Tv',
                'cat_img'=>'DemoCat.png',
            ],
            [
                'company_id'=>'2',
                'category_name'=>'Smart Tv',
                'cat_img'=>'DemoCat.png',
            ],
            [
                'company_id'=>'3',
                'category_name'=>'Smart Tv',
                'cat_img'=>'DemoCat.png',
            ], [
                'company_id'=>'1',
                'category_name'=>'Smart Phone',
                'cat_img'=>'DemoCat.png',
            ],
            [
                'company_id'=>'2',
                'category_name'=>'Smart Phone',
                'cat_img'=>'DemoCat.png',
            ],
            [
                'company_id'=>'3',
                'category_name'=>'Smart Phone',
                'cat_img'=>'DemoCat.png',
            ]
        );
        ProductCategory::insert($productCategory);
    }
}
