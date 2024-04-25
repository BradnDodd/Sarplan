<?php

namespace Database\Factories;

use App\Enums\Callout\CalloutTypeEnum;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Callout>
 */
class CalloutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $starTime = fake()->dateTimeBetween('-6 months');
        $endTime = fake()->boolean() ? fake()->dateTimeInInterval($starTime, '+10 hours') : null;
        $status = $endTime !== null ? CalloutTypeEnum::closed : CalloutTypeEnum::open;
        $teams = Team::all('id');

        return [
            'primary_team' => fake()->randomElement($teams),
            'start_time' => $starTime,
            'end_time' => $endTime,
            'status' => $status,
        ];
    }
}
