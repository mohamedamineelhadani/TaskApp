<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Projects;
use App\Models\Tasks;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mohamed Amine Elhadani',
            'email' => 'elhadanimohamedamine@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);


        Projects::factory(20)
            ->forUser($user->id)
            ->has(Tasks::factory()->count(50))
            ->create();

    }
}
