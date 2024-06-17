<?php

namespace Tests\Feature\Api\User\UserGroup;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGroupApiStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testUserGroupStoreWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $requestData = [
            'name' => 'Best Group',
            'privacy' => UserGroupPrivacyEnum::private(),
            'creator' => 1,
            'description' => 'A group for only the best people',
        ];

        $response = $this->postJson('/api/user/userGroup', $requestData);
        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'creator',
                'description',
            ]);
    }
}
