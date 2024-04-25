<?php

namespace Database\Factories;

use App\Enums\User\UserGroupPrivacyEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserGroup>
 */
class UserGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::all('id');

        return [
            'name' => fake()->text(255),
            'privacy' => fake()->randomElement(array_column(UserGroupPrivacyEnum::cases(), 'value')),
            'creator' => fake()->randomElement($userIds),
            'description' => fake()->text(),
        ];
    }
}
