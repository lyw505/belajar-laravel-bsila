<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\guru;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Walas>
 */
class WalasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'jenjang' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'namakelas' => $this->faker->randomElement(['A', 'B', 'C']),
            'tahunajaran' => '2025/2026',

            'idguru' => guru::factory()
        ];
    }
}
