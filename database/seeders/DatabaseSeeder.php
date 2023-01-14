<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();

        $this->call(UserTableSeeder::class);
        // $this->call(CreateAdminUserSeeder::class);
        // $this->call(PermissionTableSeeder::class);
        $this->call(EventCategoryTableSeeder::class);
        $this->call(EventSubCategoryTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CompanyUserTableSeeder::class);
        $this->call(StallLayoutTableSeeder::class);
        $this->call(StallTableSeeder::class);
        $this->call(StallAdsTableSeeder::class);
        $this->call(StallVisitorTableSeeder::class);
        $this->call(ProductCategoryTableSeeder::class);
        $this->call(ProductSubCategoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProductImageTableSeeder::class);
        $this->call(ProductVisitorTableSeeder::class);
        $this->call(VisitorPointDistributionTableSeeder::class);
        $this->call(VisitorPointTableSeeder::class);
        
        

    }
}
