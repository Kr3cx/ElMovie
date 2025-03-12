<?php

namespace Database\Factories;

use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profil>
 */
class ProfilFactory extends Factory
{
    public function definition(): array
    {
        return [
            'umur' => $this->faker->numberBetween(18, 60),
            'bio' => $this->faker->sentence(),
            'alamat' => $this->faker->address(),
        ];
    }
}
