<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodStoreWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team member');

        Sanctum::actingAs(
            $user,
            []
        );

        $requestData = [
            'user_id' => $user->id,
            'contact' => 'test@test.com',
            'type' => UserContactMethodTypeEnum::email(),
            'primary_method_for_type' => true,
        ];

        $response = $this->postJson('/api/user/contactMethod', $requestData);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'user_id',
                'type',
                'primary_method_for_type',
            ]);
    }
}
