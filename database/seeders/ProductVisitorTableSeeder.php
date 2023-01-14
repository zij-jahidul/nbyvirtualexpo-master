<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product\ProductVisitor ;
class ProductVisitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productVisitor = array(
            [
                'product_id'=>'1',
                'customer_id'=>'9'
            ],
            [
                'product_id'=>'2',
                'customer_id'=>'9'
            ],
            [
                'product_id'=>'3',
                'customer_id'=>'9'
            ],
            [
                'product_id'=>'4',
                'customer_id'=>'9'
            ], [
                'product_id'=>'1',
                'customer_id'=>'10'
            ],
            [
                'product_id'=>'2',
                'customer_id'=>'10'
            ],
            [
                'product_id'=>'3',
                'customer_id'=>'10'
            ],
            [
                'product_id'=>'4',
                'customer_id'=>'10'
            ],
        );
        ProductVisitor::insert($productVisitor);
    }
}
