<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'name' => $this->faker->unique()->bothify('Room-##'),
        'type' => $this->faker->randomElement(['single','double','suite']),
        'price' => $this->faker->randomFloat(2,500,5000),
        'is_available' => true,
        ];
    }
}
