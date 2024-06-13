<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\Callout;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutDeleteWithValidDataForTeamMember(): void
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
        $response = $this->deleteJson('/api/callout/'.$calloutId);
        $response->assertStatus(200);

        $callout = Callout::find($calloutId);
        $this->assertNull($callout);
    }

    public function testCalloutDeleteWithoutAnyPermissions(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            []
        );

        $callout = Callout::factory()->create([
            'primary_team' => 1,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ]);

        $calloutId = $callout->first()->id;
        $response = $this->deleteJson('/api/callout/'.$calloutId);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'You cannot delete a callout',
            ]);

        $callout = Callout::find($calloutId);
        $this->assertNotNull($callout);
    }

    public function testCalloutDeleteForNonCalloutTeamUser(): void
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
            'primary_team' => ($team->id - 1),
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ]);

        $calloutId = $callout->first()->id;
        $response = $this->deleteJson('/api/callout/'.$calloutId);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'You cannot delete a callout belonging to another team',
            ]);

        $callout = Callout::find($calloutId);
        $this->assertNotNull($callout);
    }
}
