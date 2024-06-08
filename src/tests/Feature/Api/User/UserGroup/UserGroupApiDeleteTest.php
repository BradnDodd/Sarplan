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
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $userGroup = UserGroup::factory()->create();
        $userGroupId = $userGroup->first()->id;
        $response = $this->deleteJson('/api/user/userGroup/'.$userGroupId);
        $response->assertStatus(200);

        $userGroup = UserGroup::find($userGroupId);
        $this->assertNull($userGroup);
    }
}
