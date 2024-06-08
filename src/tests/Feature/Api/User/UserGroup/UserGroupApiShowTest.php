<?php

namespace Tests\Feature\Api\User\UserGroup;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Enums\User\UserGroup\UserGroupTypeEnum;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGroupApiShowTest extends TestCase
{
    use RefreshDatabase;

    public function testUserGroupShowWithSingleRecordExpectedDataReturned(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            []
        );

        $userGroup = UserGroup::factory()->create([
            'name' => 'Best Group',
            'privacy' => UserGroupPrivacyEnum::private(),
            'creator' => 1,
            'description' => 'A group for only the best people',
        ]);

        $userGroupId = $userGroup->first()->id;
        $response = $this->getJson('/api/user/userGroup/'.$userGroupId);
        $response->assertStatus(200)
            ->assertJson([
                'id' => $userGroup->first()->id,
                'name' => 'Best Group',
                'privacy' => UserGroupPrivacyEnum::private(),
                'creator' => 1,
                'description' => 'A group for only the best people',
            ]);
    }
}
