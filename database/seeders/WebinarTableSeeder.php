<?php

namespace Database\Seeders;

use App\Models\Webinar\Webinar;
use Illuminate\Database\Seeder;

class WebinarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webinar = array(
            [
                'meeting_id'=>'alksfjas35432',
                'title'=>'Demo Meeting',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                'date'=>'2021/01/12',
                'time'=>'12:00:00',
                'duration'=>'1',
                'time_zone'=>'GMT +6',
                'status'=>'1',
            ],
            [
                'meeting_id'=>'alksfjas35432borhan',
                'title'=>'Demo Meeting',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                'date'=>'2021/01/18',
                'time'=>'12:00:00',
                'duration'=>'1',
                'time_zone'=>'GMT +6',
                'status'=>'1',
            ],
            [
                'meeting_id'=>'alksfjssas35432',
                'title'=>'Demo Meeting',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                'date'=>'2021/01/16',
                'time'=>'12:00:00',
                'duration'=>'1',
                'time_zone'=>'GMT +6',
                'status'=>'1',
            ],
            [
                'meeting_id'=>'alksfjafsas35432',
                'title'=>'Demo Meeting',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                'date'=>'2021/01/14',
                'time'=>'12:00:00',
                'duration'=>'1',
                'time_zone'=>'GMT +6',
                'status'=>'1',
            ],
            [
                'meeting_id'=>'alksfjadss35432',
                'title'=>'Demo2 Meeting',
                'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry',
                'date'=>'2021/01/13',
                'time'=>'12:00:00',
                'duration'=>'1',
                'time_zone'=>'GMT +6',
                'status'=>'1',
            ],
        );
        Webinar::insert($webinar);
    }
}
