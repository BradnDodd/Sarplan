<?php

namespace Database\Factories;

use App\Enums\User\TeamTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(255),
            'type' => fake()->randomElement(array_column(TeamTypeEnum::cases(), 'value')),
            'active' => fake()->boolean(80),
        ];
    }
}
