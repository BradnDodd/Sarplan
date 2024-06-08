<?php

namespace Tests\Feature\Api\Callout;

use App\Enums\Callout\CalloutStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutStoreWithValidData(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $requestData = [
            'primary_team' => 1,
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
}
