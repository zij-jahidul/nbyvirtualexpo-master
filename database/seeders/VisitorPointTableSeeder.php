<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor\VisitorPoint;
class VisitorPointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $visitorPoint = array(
            ['visitor_point_distribution_id'=>'1',
            'customer_id'=>'9'],
            ['visitor_point_distribution_id'=>'2',
            'customer_id'=>'9'],
            ['visitor_point_distribution_id'=>'3',
            'customer_id'=>'10'],
            ['visitor_point_distribution_id'=>'4',
            'customer_id'=>'10'],
            ['visitor_point_distribution_id'=>'1',
            'customer_id'=>'10'],
            ['visitor_point_distribution_id'=>'2',
            'customer_id'=>'10'],
        );
        VisitorPoint::insert($visitorPoint);
    }
}
