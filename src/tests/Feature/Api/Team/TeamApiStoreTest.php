<?php

namespace Tests\Feature\Api\Team;

use App\Enums\Team\TeamTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testTeamStoreWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin-super');

        Sanctum::actingAs(
            $user,
            []
        );

        $requestData = [
            'name' => 'Mountain Rescue Team',
            'type' => TeamTypeEnum::mountainRescue(),
            'active' => true,
        ];

        $response = $this->postJson('/api/team', $requestData);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'type',
                'active',
            ]);
    }
}
