<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $company = array(
            [
                'event_sub_category_id'=>'2',
                'company_name'=>'Sony',
                'company_img'=>'demo.png',
                'company_description'=>'Demo data',
                'company_expire_date'=>'2020-03-26'
            ],
            [
                'event_sub_category_id'=>'2',
                'company_name'=>'Rangs',
                'company_img'=>'demo.png',
                'company_description'=>'Demo data',
                'company_expire_date'=>'2020-03-26'
            ],
           
            [
                'event_sub_category_id'=>'2',
                'company_name'=>'Panasonic',
                'company_img'=>'demo.png',
                'company_description'=>'Demo data',
                'company_expire_date'=>'2020-03-26'
            ],
            [
                'event_sub_category_id'=>'2',
                'company_name'=>'Walton',
                'company_img'=>'demo.png',
                'company_description'=>'Demo data',
                'company_expire_date'=>'2020-03-26'
            ],
        );
        Company::insert($company);
    }
}
