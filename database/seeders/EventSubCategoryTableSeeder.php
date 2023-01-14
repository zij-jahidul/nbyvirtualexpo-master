<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\EventCategory\EventSubCategory;
class EventSubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $eventSubCategory = array(
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'FMCG',
                'event_sub_cat_img'=>'FMCG.png'
            ],
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'ELECTRONICS',
                'event_sub_cat_img'=>'ELECTRONICS.png'
            ],
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'LIFE STYLE',
                'event_sub_cat_img'=>'LIFESTYLE.png'
            ],
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'SME',
                'event_sub_cat_img'=>'SME.png'
            ],
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'Delivery System',
                'event_sub_cat_img'=>'deliverySystem.png'
            ],
            [
                'event_category_id'=>'1',
                'event_sub_category_name'=>'MFS',
                'event_sub_cat_img'=>'mfs.png'
            ]
        );
        EventSubCategory::insert($eventSubCategory);
    }
}
