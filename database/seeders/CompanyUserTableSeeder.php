<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Company\CompanyUser;
class CompanyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $companyUser = array(
            [
                'company_id'=>'1',
                'user_id'=>'3',
            ],
            [
                'company_id'=>'2',
                'user_id'=>'4',
            ],
            [
                'company_id'=>'3',
                'user_id'=>'5',
            ],
            [
                'company_id'=>'4',
                'user_id'=>'6',
            ]
        );
        CompanyUser::insert($companyUser);
    }
}
