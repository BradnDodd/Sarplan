<?php

namespace Tests\Feature\Api\Team;

use App\Enums\User\TeamTypeEnum;
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
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $team = Team::factory()->create([
            'name' => 'Mountain Rescue Team',
            'type' => TeamTypeEnum::mountainRescue(),
            'active' => true,
        ]);
        $teamId = $team->first()->id;
        $response = $this->deleteJson('/api/team/'.$teamId);
        $response->assertStatus(200);


        $team = Team::find($teamId);
        $this->assertNull($team);
    }
}
