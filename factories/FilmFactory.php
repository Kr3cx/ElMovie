<?php

namespace Database\Factories;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    public function definition(): array
    {
        $tipe = $this->faker->randomElement(['movie', 'series']);

        return [
            'genre_id' => Genre::factory(),
            'judul' => $this->faker->sentence(3),
            'ringkasan' => $this->faker->paragraph(),
            'tahun' => $this->faker->year(),
            'poster' => $this->faker->imageUrl(200, 300, 'movies'),
            'tipe' => $tipe,
            'jumlah_episode' => $tipe === 'series' ? $this->faker->numberBetween(6, 50) : null,
            'durasi' => $tipe === 'movie' ? $this->faker->numberBetween(60, 180) : null,
            'link' => $this->faker->optional()->url()
        ];
    }
}
