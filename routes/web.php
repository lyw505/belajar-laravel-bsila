<?php

use App\Http\Controllers\kbmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SiswaController;
use App\Models\siswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});


Route::get('/', [KontenController::class, 'landing'])->name('landing');

Route::get('/login', [adminController::class, 'formLogin'])->name('login');

Route::post('/login', [adminController::class, 'prosesLogin'])->name('login.post');

Route::get('/home', [siswaController::class, 'home'])->name('home')->middleware('ceklogin');

Route::get('/siswa/create', [siswaController::class, 'create'])->name('siswa.create');

Route::post('/siswa/store', [siswaController::class, 'store'])->name('siswa.store');

Route::get('/siswa/{id}/edit', [siswaController::class, 'edit'])->name('siswa.edit');

Route::put('siswa/{id}/update', [SiswaController::class, 'update'])->name('siswa.update');


Route::get('/siswa/{id}/delete', [siswaController::class, 'destroy'])->name('siswa.delete');

Route::get('/logout', [adminController::class, 'logout'])->name('logout');

Route::get('/register', [adminController::class, 'formRegister'])->name('register.form');

Route::post('/register', [adminController::class, 'prosesRegister'])->name('register.post');

Route::get('/detil/{id}', [KontenController::class, 'detil'])->name('detil');

Route::get('/jadwal', [kbmController::class, 'index'])->name('jadwal.index');

Route::get('/jadwal/guru/{idguru}', [KbmController::class, 'jadwalGuru'])->name('jadwal.guru');

Route::get('/jadwal/kelas/{idwalas}', [KbmController::class, 'jadwalKelas'])->name('jadwal.kelas');


