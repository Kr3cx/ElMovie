<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profil; // Tambahkan ini
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->profil()->create([  // Menggunakan relasi hasOne
                'umur' => $this->faker->numberBetween(18, 60),
                'bio' => $this->faker->sentence(),
                'alamat' => $this->faker->address(),
            ]);
        });
    }
}
