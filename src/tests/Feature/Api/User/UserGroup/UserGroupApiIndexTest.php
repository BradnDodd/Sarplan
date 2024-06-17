<?php

namespace Tests\Feature\Api\User\UserGroup;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGroupApiIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testUserGroupListWithRecords(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        UserGroup::factory(5)->create();
        $response = $this->getJson('/api/user/userGroup');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function testUserGroupListWithoutRecords(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $response = $this->getJson('/api/user/userGroup');

        $response
            ->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function testUserGroupListWithSingleRecordExpectedDataReturned(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $userGroup = UserGroup::factory()->create([
            'name' => 'Best Group',
            'privacy' => UserGroupPrivacyEnum::private(),
            'creator' => 1,
            'description' => 'A group for only the best people',
        ]);

        $response = $this->getJson('/api/user/userGroup');
        $response->assertStatus(200)
            ->assertJson([
                [
                    'id' => $userGroup->first()->id,
                    'name' => 'Best Group',
                    'privacy' => UserGroupPrivacyEnum::private(),
                    'creator' => 1,
                    'description' => 'A group for only the best people',
                ],
            ]);
    }
}
