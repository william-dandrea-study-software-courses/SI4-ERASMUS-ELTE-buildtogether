<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag' => $this->faker->unique()->randomElement(['c++','python','java','php','laravel','shell','javascript','angular','c','backend','frontend','linux','machine_learning']),
            'used_times' => $this->faker->numberBetween(1,100),
        ];
    }
}