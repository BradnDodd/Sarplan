<?php

namespace Tests\Feature\Api\Team;

use App\Enums\Team\TeamTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiShowTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamShowWithSingleRecordExpectedDataReturned(): void
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
        $response = $this->getJson('/api/team/'.$teamId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $team->first()->id,
                'name' => 'Mountain Rescue Team',
                'type' => TeamTypeEnum::mountainRescue()->value,
                'active' => true,
            ],
            );
    }
}
