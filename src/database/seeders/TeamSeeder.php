<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::factory(10)->create();
        $users = User::all();

        foreach ($users as $user) {
            $userGroupIds = fake()->randomElements($teams->modelKeys(), 2);
            $user->teams()->attach($userGroupIds);
        }
    }
}
