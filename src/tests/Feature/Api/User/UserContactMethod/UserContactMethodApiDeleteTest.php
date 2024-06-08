<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Models\UserContactMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodDeleteWithValidData(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $userContactMethod = UserContactMethod::factory()->create();
        $userContactMethodId = $userContactMethod->first()->id;
        $response = $this->deleteJson('/api/user/contactMethod/'.$userContactMethodId);
        $response->assertStatus(200);

        $userContactMethod = UserContactMethod::find($userContactMethodId);
        $this->assertNull($userContactMethod);
    }
}
