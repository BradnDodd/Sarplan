<?php

namespace Database\Factories;

use App\Enums\User\UserContactMethod\UserContactMethodTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserContactMethod>
 */
class UserContactMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::all('id');
        $contactMethod = fake()->randomElement(array_column(UserContactMethodTypeEnum::cases(), 'value'));
        $contact = match ($contactMethod) {
            UserContactMethodTypeEnum::telephone() => fake()->phoneNumber(),
            UserContactMethodTypeEnum::email() => fake()->email(),
            default => throw new \Exception('Unsupported contact method type: '.$contactMethod)
        };

        return [
            'user_id' => fake()->randomElement($userIds),
            'type' => $contactMethod,
            'contact' => $contact,
            'primary_method_for_type' => fake()->boolean(),
        ];
    }
}
