<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\EventCategory\EventCategory;
class EventCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $eventCategory = array(
            [
                'event_category_name'=>'Exibitions',
                'event_cat_img'=>'exibitions.png'
            ],
            [
                'event_category_name'=>'Webinar',
                'event_cat_img'=>'Webinar.png'
            ],
            [
                'event_category_name'=>'Meeting Romm',
                'event_cat_img'=>'meeting.png'
            ],
            [
                'event_category_name'=>'Media Center',
                'event_cat_img'=>'blog.png'
            ]
        );
        EventCategory::insert($eventCategory);
    }
}
