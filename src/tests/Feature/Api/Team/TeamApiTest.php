<?php

namespace Tests\Feature\Api\Team;

use App\Models\Team;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamApiTest extends TestCase
{
    public function testTeamListSuccess(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        Team::factory(5)->create();
        $response = $this->get('/api/team');

        dd($response->getBody());
    }
}
