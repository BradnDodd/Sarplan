<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutStoreWithValidData(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->assignRole('team member');
        $user->teams()->attach($team->id);
        Sanctum::actingAs(
            $user,
            []
        );

        $requestData = [
            'primary_team' => $team->id,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ];

        $response = $this->postJson('/api/callout', $requestData);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'primary_team',
                'start_time',
                'end_time',
                'status',
            ]);
    }

    public function testCalloutStoreWithoutAnyPermissions(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            []
        );

        $requestData = [
            'primary_team' => 1,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ];

        $response = $this->postJson('/api/callout', $requestData);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'You cannot create a callout',
            ]);
    }
}
