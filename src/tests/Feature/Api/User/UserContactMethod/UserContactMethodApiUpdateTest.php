<?php

namespace Tests\Feature\Api\User\UserContactMethod;

use App\Enums\UserContactMethod\UserContactMethodStatusEnum;
use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\UserContactMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserContactMethodApiUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUserContactMethodUpdateWithValidData(): void
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

        $requestData = [
            'user_id' => 1,
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
