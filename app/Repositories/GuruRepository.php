<?php

namespace App\Repositories;

use App\Models\admin;
use App\Models\guru;

class GuruRepository
{
    public function create(array $data)
    {
        // Create admin record
        $admin = admin::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'role' => 'guru',
        ]);

        // Create guru record
        $guru = guru::create([
            'id' => $admin->id,
            'nama' => $data['nama_guru'],
            'mapel' => $data['mapel'],
        ]);

        return $guru;
    }
}
