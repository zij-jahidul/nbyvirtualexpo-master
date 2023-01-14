<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Stall\StallLayout;
class StallLayoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stallLayout = array(
            [
                'company_id'=>'1',
                'event_sub_category_id'=>'2',
                'layout_name'=>'Electronics layout 1',
                'layout_img'=>'demo_laout.png',
                'layout_color'=>'#fff',
                'layout_size'=>'40',
                'layout_description'=>'demo data',
            ],[
                'company_id'=>'2',
                'event_sub_category_id'=>'2',
                'layout_name'=>'Electronics layout 2',
                'layout_img'=>'demo_laout.png',
                'layout_color'=>'#fff',
                'layout_size'=>'40',
                'layout_description'=>'demo data',
            ],[
                'company_id'=>'3',
                'event_sub_category_id'=>'2',
                'layout_name'=>'Electronics layout 3',
                'layout_img'=>'demo_laout.png',
                'layout_color'=>'#fff',
                'layout_size'=>'40',
                'layout_description'=>'demo data',
            ],
        );
        StallLayout::insert($stallLayout);
    }
}
