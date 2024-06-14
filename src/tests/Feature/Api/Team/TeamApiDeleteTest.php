<?php

namespace Tests\Feature\Api\Team;

use App\Enums\Team\TeamTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamDeleteWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin-super');

        Sanctum::actingAs(
            $user,
            []
        );

        $team = Team::factory()->create([
            'name' => 'Mountain Rescue Team',
            'type' => TeamTypeEnum::mountainRescue(),
            'active' => true,
        ]);
        $user->teams()->attach($team->id);

        $response = $this->deleteJson('/api/team/'.$team->id);
        $response->assertStatus(200);

        $team = Team::find($team->id);
        $this->assertNull($team);
    }

    public function testTeamDeleteWithoutPermissions(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $team = Team::factory()->create([
            'name' => 'Mountain Rescue Team',
            'type' => TeamTypeEnum::mountainRescue(),
            'active' => true,
        ]);
        $user->teams()->attach($team->id);

        $response = $this->deleteJson('/api/team/'.$team->id);
        $response->assertStatus(403);

        $team = Team::find($team->id);
        $this->assertNotNull($team);
    }
}
