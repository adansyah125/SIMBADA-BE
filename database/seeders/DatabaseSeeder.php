<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\KirSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\MesinSeeder;
use Database\Seeders\TanahSeeder;
use Database\Seeders\BeritaSeeder;
use Database\Seeders\GedungSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TanahSeeder::class);
        $this->call(MesinSeeder::class);
        $this->call(GedungSeeder::class);
        $this->call(KirSeeder::class);
        $this->call(BeritaSeeder::class);

        User::create([
            'name' => 'admin',
            'email' => 'adansyah225@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
