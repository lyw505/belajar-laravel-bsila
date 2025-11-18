<?php

namespace App\Repositories;

use App\Models\Siswa;
use App\Models\Admin;

class SiswaRepository
{
    public function create(array $data)
    {
        $admin = \App\Models\Admin::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'role'     => 'siswa',
        ]);

        $siswa = \App\Models\Siswa::create([
            'admin_id' => $admin->id,
            'nama'     => $data['nama'],
            'tb'       => $data['tb'],
            'bb'       => $data['bb'],
        ]);

        return $siswa;
    }
}
