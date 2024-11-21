<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'LODGRIN S.R.L.',
            'user_id' => User::factory(),
            'personal_team' => true,
            'cif' => '50457182',
            'cont_bancar' => 'RO77BTRLRONCRT0CU6156001'
        ];
    }
}
