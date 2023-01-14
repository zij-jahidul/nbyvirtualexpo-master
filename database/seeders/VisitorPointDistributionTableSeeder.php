<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor\VisitorPointDistribution;
class VisitorPointDistributionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        //
        $visitorPointDistribution = array(
            ['slug_name'=>'lobby',
            'point'=>'5'],
            ['slug_name'=>'exhibitionlobby',
            'point'=>'5'],
            ['slug_name'=>'stall',
            'point'=>'5'],
            ['slug_name'=>'product',
            'point'=>'5'],
            ['slug_name'=>'webinar',
            'point'=>'5'],
            ['slug_name'=>'blog',
            'point'=>'5'],
            ['slug_name'=>'meetingroom',
            'point'=>'5'],
        );
        VisitorPointDistribution::insert($visitorPointDistribution);
    }
}
