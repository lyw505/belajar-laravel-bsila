<?php

namespace App\Http\Controllers;

use App\Models\Admin;  
use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function formLogin()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            $namaLengkap = $admin->username; // default

            // Jika role guru → ambil dari dataguru (FK = id)
            if ($admin->role === 'guru') {
                $guru = DB::table('dataguru')->where('id', $admin->id)->first();
                if ($guru) {
                    $namaLengkap = $guru->nama;
                }
            }

            // Jika role siswa → ambil dari datasiswa
            if ($admin->role === 'siswa') {
                $siswa = DB::table('datasiswa')->where('admin_id', $admin->id)->first();
                if ($siswa) {
                    $namaLengkap = $siswa->nama;
                }
            }

            // simpan session
            session([
                'admin_id'       => $admin->id,
                'admin_username' => $admin->username,
                'admin_role'     => $admin->role,
                'admin_nama'     => $namaLengkap,
            ]);

            return redirect()->route('home');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->forget(['admin_id', 'admin_username', 'admin_role', 'admin_nama']);
        return redirect()->route('landing');
    }

    public function formRegister()
    {
        return view('register');
    }

    public function prosesRegister(Request $request)
    {
        try {
            $request->validate([
                'username'  => 'required|unique:dataadmin,username',
                'password'  => 'required',
                'role'      => 'required',
                'nama_guru' => 'required_if:role,guru',
                'mapel'     => 'required_if:role,guru',
                'nama'      => 'required_if:role,siswa',
                'tb'        => 'required_if:role,siswa',
                'bb'        => 'required_if:role,siswa',
            ]);

            // Simpan user ke tabel dataadmin
            $id = DB::table('dataadmin')->insertGetId([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role'     => $request->role,
            ]);

            // Kalau role guru, simpan ke tabel dataguru
            if ($request->role === 'guru') {
                DB::table('dataguru')->insert([
                    'id'    => $id, // FK ke dataadmin.id
                    'nama'  => $request->nama_guru,
                    'mapel' => $request->mapel,
                ]);
            }

            // Kalau role siswa, simpan ke tabel datasiswa
            if ($request->role === 'siswa') {
                DB::table('datasiswa')->insert([
                    'admin_id' => $id, // FK ke dataadmin.id
                    'nama'     => $request->nama,
                    'tb'       => $request->tb,
                    'bb'       => $request->bb,
                ]);
            }

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Registrasi gagal: ' . $e->getMessage());
        }
    }

    public function home()
    {
        $guru = null;
        $siswa = null;
        $daftarSiswa = collect();

        if (session('admin_role') === 'guru') {
            $guru = DB::table('dataguru')->where('id', session('admin_id'))->first();
        } elseif (session('admin_role') === 'siswa') {
            $siswa = DB::table('datasiswa')->where('admin_id', session('admin_id'))->first();
        } elseif (session('admin_role') === 'admin') {
            $daftarSiswa = DB::table('datasiswa')->get();
        }

        return view('home', compact('guru', 'siswa', 'daftarSiswa'));
    }
}
