<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\User;
use App\Models\UserContactMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodUpdateWithValidData(): void
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

        $requestData = [
            'user_id' => $user->id,
            'contact' => 'test@test.com',
            'type' => UserContactMethodTypeEnum::email(),
            'primary_method_for_type' => false,
        ];

        $response = $this->patchJson('/api/user/contactMethod/'.$userContactMethod->first()->id, $requestData);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'primary_method_for_type' => false,
            ]);
    }
}
