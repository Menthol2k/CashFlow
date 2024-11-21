<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->withPersonalTeam()->create([
            'name' => 'Lamba Gabriel Octavian',
            'email' => 'lambaoctavian17@gmail.com',
            'password' => Hash::make('123456'),

        ]);

        $this->call(ClientSeeder::class);
        $this->call(EcashmentSeeder::class);
    }
}