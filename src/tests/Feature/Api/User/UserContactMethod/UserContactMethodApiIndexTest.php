<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\User\UserContactMethod\UserContactMethodStatusEnum;
use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\UserContactMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodListWithRecords(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        UserContactMethod::factory(5)->create();
        $response = $this->getJson('/api/user/contactMethod');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function testUserContactMethodListWithoutRecords(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $response = $this->getJson('/api/user/contactMethod');

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testUserContactMethodListWithSingleRecordExpectedDataReturned(): void
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

        $response = $this->getJson('/api/user/contactMethod');
        $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $userContactMethod->first()->id,
                    'user_id' => 1,
                    'contact' => 'test@test.com',
                    'type' => UserContactMethodTypeEnum::email(),
                    'primary_method_for_type' => true,
                ],
            ]);
    }
}
