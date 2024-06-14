<?php

namespace Tests\Feature\Api\Team;

use App\Enums\Team\TeamTypeEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamUpdateWithValidData(): void
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
        $requestData = [
            'id' => $team->first()->id,
            'name' => 'Awesome Mountain Rescue Team',
            'type' => TeamTypeEnum::mountainRescue(),
            'active' => true,
        ];

        $response = $this->patchJson('/api/team/'.$team->first()->id, $requestData);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Awesome Mountain Rescue Team',
            ]);
    }
}
