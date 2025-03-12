<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ulasan>
 */
class UlasanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'film_id' => Film::factory(),
            'rating' => $this->faker->numberBetween(1, 10),
            'review' => $this->faker->sentence(),
        ];
    }
}
