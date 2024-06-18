<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\User;
use App\Models\UserContactMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodListWithRecords(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team member');

        Sanctum::actingAs(
            $user,
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
        $user = User::factory()->create();
        $user->assignRole('team member');

        Sanctum::actingAs(
            $user,
            []
        );

        $response = $this->getJson('/api/user/contactMethod');

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testUserContactMethodListWithSingleRecordExpectedDataReturned(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team member');

        Sanctum::actingAs(
            $user,
            []
        );

        $userContactMethod = UserContactMethod::factory()->create([
            'user_id' => $user->id,
            'contact' => 'test@test.com',
            'type' => UserContactMethodTypeEnum::email(),
            'primary_method_for_type' => true,
        ]);

        $response = $this->getJson('/api/user/contactMethod');
        $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $userContactMethod->first()->id,
                    'user_id' => $user->id,
                    'contact' => 'test@test.com',
                    'type' => UserContactMethodTypeEnum::email(),
                    'primary_method_for_type' => true,
                ],
            ]);
    }
}
