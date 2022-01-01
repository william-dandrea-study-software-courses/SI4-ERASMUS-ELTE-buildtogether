<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  $users = User::pluck('id')->toArray();
        
        return [
        'name' => $this->faker->sentence(10),
        'summary' => $this->faker->sentence(50),
        'owner' => $this->faker->randomElement($users),
        'ptype'=>$this->faker->randomElement(['longTerm', 'hackathon']),
        'category'=>$this->faker->randomElement(['technology', 'marketing', 'education', 'finance', 'business']),
        'totalFund'=> $this->faker->numberBetween($min = 0, $max = 200000),
        'achievedFund'=> $this->faker->numberBetween($min = 0, $max = 200000),
        'startDate'=>Carbon::today()->toDateString(),
        'endDate'=>Carbon::today()->toDateString(),
        #'photo' => ,


    ];
 }
}
