<?php

namespace App\Repositories;

use App\Models\Siswa;
use App\Models\Admin;

class SiswaRepository
{
    public function create(array $data)
    {
        $admin = Admin::create([
            'username' => $data['nama'],
            'password' => bcrypt($data['nama']),
            'role'     => 'siswa',
        ]);

        $siswa = Siswa::create([
            'admin_id' => $admin->id,
            'nama'     => $data['nama'],
            'tb'       => $data['tb'],
            'bb'       => $data['bb'],
        ]);

        return $siswa;
    }
}
