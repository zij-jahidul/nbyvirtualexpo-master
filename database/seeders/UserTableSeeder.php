<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userArray=array(
            [
                'name' => 'Super Admin',
                'email' => 'super_admin@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Sony',
                'email' => 'company1@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Rangs',
                'email' => 'company2@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Panasonic',
                'email' => 'company3@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Walton',
                'email' => 'company4@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Bloger1',
                'email' => 'bloger1@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Bloger2',
                'email' => 'bloger2@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Customer1',
                'email' => 'customer1@expo.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Customer2',
                'email' => 'customer2@expo.com',
                'password' => bcrypt('123456')
            ]
        );

        
        User::insert($userArray);
    }
}
