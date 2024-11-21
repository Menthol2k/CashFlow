<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'team_id' => 1,
                'denumire' => 'TRACKING WASTE MANAGEMENT S.R.L.',
                'cui' => '40710260',
                'regcom' => 'J2019002620400',
                'adresa' => 'Municipiul Bucuresti, Sector 3, Int Baba Novac, Nr.19a, Imobilul Belvedere',
                'tara' => 'Romania',
                'judet' => 'Bucuresti',
                'localitate' => 'Sector 3',
                'platitor_tva' => true,
            ],
        ])->each(function ($factory) {
            Client::create($factory);
        });
    }
}
