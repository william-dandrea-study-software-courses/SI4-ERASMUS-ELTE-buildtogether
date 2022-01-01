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
        $this->call(UserTableSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(InvestmentSeeder::class);
        



    }
}