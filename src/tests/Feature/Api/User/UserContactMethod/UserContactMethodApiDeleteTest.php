<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Models\User;
use App\Models\UserContactMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodDeleteWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team member');

        Sanctum::actingAs(
            $user,
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
