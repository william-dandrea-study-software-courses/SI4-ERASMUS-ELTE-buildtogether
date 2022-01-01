<?php

namespace Database\Seeders;
use App\Models\Investment;
use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Investment::factory()
        ->count(10)
        ->create();
    }
}
