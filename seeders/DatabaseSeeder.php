<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin10',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('themoviemeter'), 
        ]);
    }
}