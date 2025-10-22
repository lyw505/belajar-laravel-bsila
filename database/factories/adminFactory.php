<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;   
use App\Models\Admin;                 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;   

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('123'),
            'role' => 'siswa'
        ];
    }

    public function dataadmin1()
    {
        return $this->state([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role'     => 'admin',
        ]);
    }

    public function dataadmin2()
    {
        return $this->state([
            'username' => 'user',
            'password' => Hash::make('user'),
            'role'     => 'user',
        ]);
    }
}