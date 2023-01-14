<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = array(
            [
                'stall_id'=>'1',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product ',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],[
                'stall_id'=>'1',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product 2',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],
            [
                'stall_id'=>'1',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product 3',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],
            [
                'stall_id'=>'2',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product ',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],[
                'stall_id'=>'2',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product 2',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],
            [
                'stall_id'=>'3',
                'product_category_id'=>'1',
                'product_sub_category_id'=>'1',
                'product_name'=>'sample Product 3',
                'product_code'=>'2020',
                'product_img'=>'product.png',
                'color'=>'white',
                'size'=>'XL',
                'cost_price'=>'200',
                'selling_price'=>'250',
                'wholesale_price'=>'220',
                'offer_price'=>'240',
                'description'=>'Demo data',
            ],
        );
        Product::insert($product);
    }
}
