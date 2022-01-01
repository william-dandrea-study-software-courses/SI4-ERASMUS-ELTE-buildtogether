<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interest::factory(5)->create();
        $users = User::All();
        Interest::all()->each(function ($interest) use ($users) {
            $user_ids = $users->random(rand(4, $users->count()))->pluck('id')->toArray();
            $interest->users()->attach($user_ids);
        });
    }
}