<?php

namespace Tests\Feature\Api\User\UserGroup;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGroupApiDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testUserGroupDeleteWithValidData(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $userGroup = UserGroup::factory()->create();
        $user->groups()->attach($userGroup->id);

        $userGroupId = $userGroup->first()->id;
        $response = $this->deleteJson('/api/user/userGroup/'.$userGroupId);
        $response->assertStatus(200);

        $userGroup = UserGroup::find($userGroupId);
        $this->assertNull($userGroup);
    }

    public function testUserGroupDeleteWithoutPermissions(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs(
            $user,
            []
        );

        $userGroup = UserGroup::factory()->create();
        $user->groups()->attach($userGroup->id);

        $userGroupId = $userGroup->first()->id;
        $response = $this->deleteJson('/api/user/userGroup/'.$userGroupId);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'You cannot delete a user group',
            ]);

        $userGroup = UserGroup::find($userGroupId);
        $this->assertNotNull($userGroup);
    }

    public function testUserGroupDeleteForDifferentGroup(): void
    {
        $user = User::factory()->create();
        $user->assignRole('team leader');

        Sanctum::actingAs(
            $user,
            []
        );

        $userGroup = UserGroup::factory()->create();
        $userGroupId = $userGroup->first()->id;

        $response = $this->deleteJson('/api/user/userGroup/'.$userGroupId);
        $response->assertStatus(403)
            ->assertJson([
                'message' => 'You cannot delete another teams user group',
            ]);

        $userGroup = UserGroup::find($userGroupId);
        $this->assertNotNull($userGroup);
    }
}
