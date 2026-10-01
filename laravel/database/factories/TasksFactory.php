<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tasks;
use App\Models\Projects;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tasks::class;

    public function definition(): array
    {
        return [
            'id_project'  => Projects::factory(),
            'title'       => $this->faker->sentence(rand(2, 5)),
            'description' => $this->faker->optional(0.5)->paragraph(),
            'status'      => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
