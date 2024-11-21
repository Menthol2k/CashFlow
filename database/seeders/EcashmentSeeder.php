<?php

namespace Database\Seeders;

use App\Models\Encashment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcashmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'numar' => '616ZEXA2432303HE',
                'data_emiterii' => '2024-11-18',
                'valoare' => '10155',
            ],
            [
                'numar' => '616ZEXA24313001Q',
                'data_emiterii' => '2024-11-08',
                'valoare' => '1785',
            ]
        ])->each(function ($factory) {
            Encashment::create([
                'client_id' => 1,
                'team_id' => 1,
                'tva' => true,
                'tip_document' => 'Alta incasare',
                'cont_bancar' => 'RO77BTRLRONCRT0CU6156001',
                'numar' => $factory['numar'],
                'data_emiterii' => $factory['data_emiterii'],
                'valoare' => $factory['valoare']
            ]);
        });
    }
}
