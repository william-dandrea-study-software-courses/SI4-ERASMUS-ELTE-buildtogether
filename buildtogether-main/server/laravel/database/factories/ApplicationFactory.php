<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Position;
use App\Models\Application;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
{      $positions = Position::pluck('id')->toArray();
       $users = User::pluck('id')->toArray();

        
        return [
            'position_id' => $this->faker->randomElement($positions),
            'applicant_id' => $this->faker->randomElement($users), 
            'status' => $this->faker-> randomElement(['inProcess', 'accepted','rejected']),
            'applicationDate' => Carbon::today()->toDateString(),
            'comment' => $this->faker->sentence(50),     
         
    ];
 }
}
