<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'tb' => $this->faker->numberBetween(140, 180),
            'bb' => $this->faker->numberBetween(35, 80),

            // relasi ke dataadmin (role siswa)
            'admin_id' => Admin::factory()->create(['role' => 'siswa'])->id,
        ];
    }
}
