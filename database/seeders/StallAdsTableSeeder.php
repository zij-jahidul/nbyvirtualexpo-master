<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Stall\StallAds;
class StallAdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stallAds = array(
            [
            'stall_id'=>'1',
            'ads'=>'BannerImage.png',
            'ads_type'=>'0',
            ],
            [
            'stall_id'=>'1',
            'ads'=>'BannerImage1.png',
            'ads_type'=>'0',
            ],[
            'stall_id'=>'1',
            'ads'=>'BannerImage2.png',
            'ads_type'=>'0',
            ], [
            'stall_id'=>'1',
            'ads'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/77qLmyO93To" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'ads_type'=>'1',
            ],
            [
            'stall_id'=>'1',
            'ads'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/77qLmyO93To" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'ads_type'=>'1',
            ],[
            'stall_id'=>'1',
            'ads'=>'<iframe width="560" height="315" src="https://www.youtube.com/embed/77qLmyO93To" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            'ads_type'=>'1',
            ],
        );
        StallAds::insert($stallAds);
    }
}
