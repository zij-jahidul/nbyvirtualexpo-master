<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product\ProductImage;
class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productImage = array(
            [
                'product_id'=>'1',
                'image'=>'productAddionalImage.png',
            ],[
                'product_id'=>'1',
                'image'=>'productAddionalImage2.png',
            ],[
                'product_id'=>'1',
                'image'=>'productAddionalImage3.png',
            ],[
                'product_id'=>'1',
                'image'=>'productAddionalImage4.png',
            ],[
                'product_id'=>'1',
                'image'=>'productAddionalImage5.png',
            ],[
                'product_id'=>'2',
                'image'=>'productAddionalImage.png',
            ],[
                'product_id'=>'2',
                'image'=>'productAddionalImage2.png',
            ],[
                'product_id'=>'2',
                'image'=>'productAddionalImage3.png',
            ],[
                'product_id'=>'2',
                'image'=>'productAddionalImage4.png',
            ],[
                'product_id'=>'2',
                'image'=>'productAddionalImage5.png',
            ],
        );
        ProductImage::insert($productImage);
    }
}
