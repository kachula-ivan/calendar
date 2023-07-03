<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function Symfony\Component\Translation\t;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDateTime = $this->faker->dateTimeBetween('-30 days', '+90 days');
        $endDateTime = $this->faker->dateTimeBetween($startDateTime, '+90 days');

        return [
            'title' => $this->faker->sentence(),
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'done' => $this->faker->numberBetween(0, 1),
            'group' => $this->faker->randomElement(['1','2','3']),
            'color' => $this->faker->randomElement(['1','2','3','4','5','6']),
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
