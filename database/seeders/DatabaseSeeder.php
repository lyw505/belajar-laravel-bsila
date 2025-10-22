<?php

namespace Database\Seeders;

use App\Models\kbm;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Konten;
use App\Models\Guru;
use App\Models\Walas;
use App\Models\Kelas;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat admin
        Admin::factory()->dataadmin1()->create();

        // buat konten
        Konten::factory()->count(10)->create();

        // buat guru & siswa
        $gurus = Guru::factory(10)->create();
        $siswas = Siswa::factory(25)->create();

        // Ambil 3 guru random untuk jadi walas
        $guruWalas = $gurus->random(3);

        // buat kbm
        kbm::factory(5)->create();

        // Jenjang & kelas fix
        $jenjangs = ['X', 'XI', 'XII'];
        $kelas = ['A', 'B', 'C'];

        foreach ($guruWalas as $index => $guru) {
            Walas::factory()->create([
                'idguru' => $guru->idguru,
                'jenjang' => $jenjangs[$index],
                'namakelas' => $kelas[$index],
            ]);
        }


        // ambil semua id walas
        $waliKelasIds = Walas::pluck('idwalas')->toArray();

        // acak siswa
        $randomSiswas = $siswas->shuffle();

        // distribusi siswa ke tiap walas
        $chunks = $randomSiswas->chunk(
            ceil($randomSiswas->count() / count($waliKelasIds))
        );
        foreach ($waliKelasIds as $index => $idwalas) {
            if (isset($chunks[$index])) {
                foreach ($chunks[$index] as $siswa) {
                    Kelas::create([
                        'idwalas' => $idwalas,
                        'idsiswa' => $siswa->idsiswa
                    ]);
                }
            }
        }
    }
}
