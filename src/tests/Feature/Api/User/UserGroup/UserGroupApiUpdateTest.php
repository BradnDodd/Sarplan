<?php

namespace Tests\Feature\Api\User\UserGroup;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Enums\User\UserGroup\UserGroupTypeEnum;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserGroupApiUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUserGroupUpdateWithValidData(): void
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

        $requestData = [
            'name' => 'Second Best Group',
            'privacy' => UserGroupPrivacyEnum::private(),
            'creator' => 1,
            'description' => 'A group for only the best people',
        ];

        $response = $this->patchJson('/api/user/userGroup/'.$userGroup->first()->id, $requestData);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Second Best Group',
            ]);
    }
}
