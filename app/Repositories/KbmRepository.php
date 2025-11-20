<?php

namespace App\Repositories;

use App\Models\kbm;

class KbmRepository
{
    public function create(array $data)
    {
        return kbm::create([
            'idguru'  => $data['idguru'],
            'idwalas' => $data['idwalas'],
            'hari'    => $data['hari'],
            'mulai'   => $data['mulai'],
            'selesai' => $data['selesai'],
        ]);
    }
}
