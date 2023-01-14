<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Stall\StallVisitor;
class StallVisitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $stallVisitor = array(
            [
                'customer_id'=>'9',
                'stall_id'=>'1',
            ],
            [
                'customer_id'=>'9',
                'stall_id'=>'2',
            ],
            [
                'customer_id'=>'10',
                'stall_id'=>'1',
            ],
            [
                'customer_id'=>'10',
                'stall_id'=>'1',
            ],
            [
                'customer_id'=>'9',
                'stall_id'=>'3',
            ],
        );
        StallVisitor::insert($stallVisitor);
    }
}
