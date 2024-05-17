<?php

namespace Tests\Feature\Api\Team;

use App\Enums\User\TeamTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamListWithRecords(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        Team::factory(5)->create();
        $response = $this->getJson('/api/team');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function testTeamListWithoutRecords(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->getJson('/api/team');

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testTeamListWithSingleRecordExpectedDataReturned(): void
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

        $response = $this->getJson('/api/team');
        $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $team->first()->id,
                    'name' => 'Mountain Rescue Team',
                    'type' => TeamTypeEnum::mountainRescue()->value,
                    'active' => true,
                ],
            ]);
    }
}
