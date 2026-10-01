<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Projects;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects>
 */
class ProjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Projects::class;

    public function definition(): array
    {
        return [
            'id_user'     => User::factory(),
            'name'        => $this->faker->sentence(rand(2, 4)),
            'description' => $this->faker->optional(0.7)->paragraph(),
            'status'      => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }


    public function forUser($userId)
    {
        return $this->state(fn() => ['id_user' => $userId]);
    }
}