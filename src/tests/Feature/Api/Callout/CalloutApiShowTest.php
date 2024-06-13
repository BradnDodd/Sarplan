<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\Callout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiShowTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutShowWithSingleRecordExpectedDataReturned(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $callout = Callout::factory()->create([
            'primary_team' => 1,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => null,
            'status' => CalloutStatusEnum::open(),
        ]);

        $calloutId = $callout->first()->id;
        $response = $this->getJson('/api/callout/'.$calloutId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $callout->first()->id,
                'primary_team' => 1,
                'start_time' => '2024-01-01 17:00:00',
                'end_time' => null,
                'status' => CalloutStatusEnum::open(),
            ]);
    }
}