<?php

namespace Database\Factories;


use App\Models\Project;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
{      $projects = Project::pluck('id')->toArray();

        
        return [
        'title' => $this->faker->randomElement(['FrontEnd Developer', 'BackEnd Developer','Designer','Full Stack Developer']),
        'project_id' =>  $this->faker->randomElement($projects),
        'status' =>  $this->faker->randomElement(['Open', 'Closed']),

        
         
    ];
 }
}
