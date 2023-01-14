<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Stall\Stall;
class StallTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stall = array(
            [
                'company_id'=>'1',
                'stall_layout_id'=>'1',
                'event_sub_category_id'=>'2',
                'stall_name'=>'Sony',
                'brand_name'=>'Sony',
                'manufacturer_name'=>'Sony',
                'open_time'=>'09:09:20',
                'close_time'=>'08:50:45',
                'stall_brochure'=>'brochure.pdf',
                'stall_description'=>'demo',
                'stall_live_boardcust'=>'video boardcust',
                'stall_announcement'=>'Voice boardcust',
            ],[
                'company_id'=>'2',
                'stall_layout_id'=>'2',
                'event_sub_category_id'=>'2',
                'stall_name'=>'Rangs',
                'brand_name'=>'Rangs',
                'manufacturer_name'=>'Rangs',
                'open_time'=>'09:09:20',
                'close_time'=>'08:50:45',
                'stall_brochure'=>'brochure.pdf',
                'stall_description'=>'demo',
                'stall_live_boardcust'=>'video boardcust',
                'stall_announcement'=>'Voice boardcust',
            ],[
                'company_id'=>'3',
                'stall_layout_id'=>'3',
                'event_sub_category_id'=>'2',
                'stall_name'=>'Panasonic',
                'brand_name'=>'Panasonic',
                'manufacturer_name'=>'Panasonic',
                'open_time'=>'09:09:20',
                'close_time'=>'08:50:45',
                'stall_brochure'=>'brochure.pdf',
                'stall_description'=>'demo',
                'stall_live_boardcust'=>'video boardcust',
                'stall_announcement'=>'Voice boardcust',
            ],
            [
                'company_id'=>'4',
                'stall_layout_id'=>'1',
                'event_sub_category_id'=>'2',
                'stall_name'=>'Walton',
                'brand_name'=>'Walton',
                'manufacturer_name'=>'Walton',
                'open_time'=>'09:09:20',
                'close_time'=>'08:50:45',
                'stall_brochure'=>'brochure.pdf',
                'stall_description'=>'demo',
                'stall_live_boardcust'=>'video boardcust',
                'stall_announcement'=>'Voice boardcust',
            ]
        );
        Stall::insert($stall);
    }
}
