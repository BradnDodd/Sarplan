<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\Callout;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiShowTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutShowWithSingleRecordExpectedDataReturned(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->assignRole('team member');
        $user->teams()->attach($team->id);
        Sanctum::actingAs(
            $user,
            []
        );

        $callout = Callout::factory()->create([
            'primary_team' => $team->id,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ]);

        $calloutId = $callout->first()->id;
        $response = $this->getJson('/api/callout/'.$calloutId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $callout->first()->id,
                'primary_team' => $team->id,
                'start_time' => '2024-01-01 17:00:00',
                'end_time' => null,
                'status' => CalloutStatusEnum::open(),
            ]);
    }
    public function testCalloutShowWithSingleRecordTeamLeaderViewOtherTeams(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create();
        $user->assignRole('team leader');
        $user->teams()->attach($team->id);
        Sanctum::actingAs(
            $user,
            []
        );

        $callout = Callout::factory()->create([
            'primary_team' => ($team->id + 1),
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ]);

        $calloutId = $callout->first()->id;
        $response = $this->getJson('/api/callout/'.$calloutId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $callout->first()->id,
                'primary_team' => ($team->id + 1),
                'start_time' => '2024-01-01 17:00:00',
                'end_time' => null,
                'status' => CalloutStatusEnum::open(),
            ]);
    }
}
