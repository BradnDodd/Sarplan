<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userGroups = UserGroup::factory(10)->create();
        $users = User::all();

        foreach ($users as $user) {
            $userGroupIds = fake()->randomElements($userGroups->modelKeys(), 2);
            $user->groups()->attach($userGroupIds);
        }
    }
}
