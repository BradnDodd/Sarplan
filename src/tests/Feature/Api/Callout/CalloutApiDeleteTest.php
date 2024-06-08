<?php

namespace Tests\Feature\Api\Callout;

use App\Models\Callout;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CalloutApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testCalloutDeleteWithValidData(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $callout = Callout::factory()->create();
        $calloutId = $callout->first()->id;
        $response = $this->deleteJson('/api/callout/'.$calloutId);
        $response->assertStatus(200);

        $callout = Callout::find($calloutId);
        $this->assertNull($callout);
    }
}
