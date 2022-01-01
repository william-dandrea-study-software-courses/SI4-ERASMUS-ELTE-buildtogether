<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Project;
use App\Models\Investment;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Investment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  $users = User::pluck('id')->toArray();
       $projects = Project::pluck('id')->toArray();

        
        return [
        'user_id' => $this->faker->randomElement($users),
        'project_id' =>  $this->faker->randomElement($projects),
        'amount' => $this->faker->numberBetween($min = 0, $max = 20000),
         
    ];
 }
}
