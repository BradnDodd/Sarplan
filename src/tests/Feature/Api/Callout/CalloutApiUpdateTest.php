<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\Callout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutUpdateWithValidData(): void
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

        $requestData = [
            'id' => $callout->first()->id,
            'primary_team' => 1,
            'start_time' => '2024-01-01 17:00:00',
            'end_time' => '2024-01-02 17:00:00',
            'status' => CalloutStatusEnum::closed(),
        ];

        $response = $this->patchJson('/api/callout/'.$callout->first()->id, $requestData);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'end_time' => '2024-01-02 17:00:00',
                'status' => CalloutStatusEnum::closed(),
            ]);
    }
}
