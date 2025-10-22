<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\guru;
use App\Models\kbm;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function home()
    {
        // Kalau belum login
        if (!session()->has('admin_id')) {
            return redirect()->route('login');
        }

        $siswa = null;
        $guru = null;
        $daftarSiswa = collect();

        // Kalau role = siswa
        if (session('admin_role') === 'siswa') {
            // Ambil data dasar siswa
            $siswa = DB::table('datasiswa')
                ->where('admin_id', session('admin_id'))
                ->select('idsiswa', 'nama', 'tb', 'bb')
                ->first();

            // Kalau sudah ada kelas, tambahkan info kelas + walas
            if ($siswa) {
                $kelas = DB::table('datakelas')
                    ->join('datawalas', 'datakelas.idwalas', '=', 'datawalas.idwalas')
                    ->join('dataguru', 'datawalas.idguru', '=', 'dataguru.idguru')
                    ->where('datakelas.idsiswa', $siswa->idsiswa)
                    ->select(
                        'datawalas.jenjang',
                        'datawalas.namakelas',
                        'dataguru.nama as walas_nama'
                    )
                    ->first();

                if ($kelas) {
                    $siswa->jenjang = $kelas->jenjang;
                    $siswa->namakelas = $kelas->namakelas;
                    $siswa->walas_nama = $kelas->walas_nama;
                }
            }
        }

        // Kalau role = guru
        if (session('admin_role') === 'guru') {
            $guru = DB::table('dataadmin')
                ->join('dataguru', 'dataadmin.id', '=', 'dataguru.id') // FK benar
                ->leftJoin('datawalas', 'dataguru.idguru', '=', 'datawalas.idguru')
                ->where('dataadmin.id', session('admin_id'))
                ->select(
                    'dataguru.nama as nama',
                    'dataguru.mapel',
                    'datawalas.jenjang',
                    'datawalas.namakelas',
                    'datawalas.idwalas'
                )
                ->first();

            // guru hanya lihat siswa di kelas yang dia walas
            if ($guru && $guru->idwalas) {
                $daftarSiswa = DB::table('datasiswa')
                    ->join('datakelas', 'datasiswa.idsiswa', '=', 'datakelas.idsiswa')
                    ->where('datakelas.idwalas', $guru->idwalas)
                    ->select('datasiswa.*')
                    ->get();
            }


        }

        // Kalau role = admin
        if (session('admin_role') === 'admin') {
            $daftarSiswa = DB::table('datasiswa')->get();
        }

        return view('home', compact('siswa', 'guru', 'daftarSiswa'));
    }

    public function edit($id)
    {
        if (session('admin_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        if (session('admin_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        $request->validate([
            'nama' => 'required|string|max:100',
            'tb' => 'required|integer',
            'bb' => 'required|integer',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nama' => $request->nama,
            'tb' => $request->tb,
            'bb' => $request->bb,
        ]);

        return redirect()->route('home')->with('success', 'Data siswa berhasil diupdate.');
    }

    public function create()
    {
        if (session('admin_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:dataadmin,username',
            'password' => 'required',
            'nama' => 'required|string|max:100',
            'tb' => 'required|integer',
            'bb' => 'required|integer',
        ]);

        // Simpan user ke tabel dataadmin
        $id = DB::table('dataadmin')->insertGetId([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'siswa',
        ]);

        // Simpan ke tabel datasiswa
        Siswa::create([
            'nama' => $request->nama,
            'tb' => $request->tb,
            'bb' => $request->bb,
            'admin_id' => $id,
        ]);

        return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (session('admin_role') !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak');
        }

        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('home')->with('success', 'Data siswa berhasil dihapus.');
    }
    public function index()
    {
        // Ambil semua jadwal lengkap dengan guru, walas, kelas
        $jadwals = kbm::with(['guru', 'walas', 'kelas'])->get();

        // Ambil data siswa / guru jika perlu
        $daftarSiswa = Siswa::all(); // misal
        $guru = guru::find(session('admin_id')); // kalau login sebagai guru
        $siswa = Siswa::find(session('admin_id')); // kalau login sebagai siswa

        return view('home', compact('jadwals', 'daftarSiswa', 'guru', 'siswa'));
    }
}
