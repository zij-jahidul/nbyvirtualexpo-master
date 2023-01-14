<?php

namespace Database\Seeders;

use App\Models\Webinar\WebinarUser;
use Illuminate\Database\Seeder;

class WebinarUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webinarUser = array(
            [
                'webinar_id'=>'1',
                'name'=>'Borhan Uddin',
                'designation'=>'Web Developer',
                'image'=>'product.png',
                'status'=>'1',
            ],
            [
                'webinar_id'=>'1',
                'name'=>'Borhan4 Uddin',
                'designation'=>'Web Developer',
                'image'=>'product.png',
                'status'=>'1',
            ],
            [
                'webinar_id'=>'2',
                'name'=>'Borhan2 Uddin',
                'designation'=>'Web Developer',
                'image'=>'product.png',
                'status'=>'1',
            ],
            [
                'webinar_id'=>'2',
                'name'=>'Borhan1 Uddin',
                'designation'=>'Web Developer',
                'image'=>'product.png',
                'status'=>'1',
            ],
        );
        WebinarUser::insert($webinarUser);
    }
}
