<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\User;
use App\Models\UserContactMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiShowTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodShowWithSingleRecordExpectedDataReturned(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $userContactMethod = UserContactMethod::factory()->create([
            'user_id' => 1,
            'contact' => 'test@test.com',
            'type' => UserContactMethodTypeEnum::email(),
            'primary_method_for_type' => true,
        ]);

        $userContactMethodId = $userContactMethod->first()->id;
        $response = $this->getJson('/api/user/contactMethod/'.$userContactMethodId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $userContactMethod->first()->id,
                'user_id' => 1,
                'contact' => 'test@test.com',
                'type' => UserContactMethodTypeEnum::email(),
                'primary_method_for_type' => true,
            ]);
    }
}
