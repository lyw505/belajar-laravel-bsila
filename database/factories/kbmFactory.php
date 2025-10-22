<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\Walas;
use Illuminate\Database\Eloquent\Factories\Factory;

class KbmFactory extends Factory
{
    public function definition()
    {
        // Pastikan ada guru
        if (Guru::count() === 0) {
            Guru::factory()->count(5)->create();
        }

        // Pastikan ada walas
        if (Walas::count() === 0) {
            Walas::factory()->count(3)->create();
        }

        return [
            'idguru' => Guru::inRandomOrder()->first()->idguru,
            'idwalas' => Walas::inRandomOrder()->first()->idwalas,
            'hari' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'mulai' => $this->faker->randomElement(['07:00', '08:30', '10:00', '11:30', '13:00']),
            'selesai' => $this->faker->randomElement(['08:30', '10:00', '11:30', '13:00', '14:30']),
        ];
    }
}
