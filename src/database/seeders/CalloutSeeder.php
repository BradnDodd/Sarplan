<?php

namespace Database\Seeders;

use App\Models\Callout;
use App\Models\Team;
use Illuminate\Database\Seeder;

class CalloutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            Callout::factory(50)->create(['primary_team' => $team->id]);
        }
    }
}
