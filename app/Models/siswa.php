<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'datasiswa';       // nama tabel
    protected $primaryKey = 'idsiswa';    // PK custom
    public $incrementing = true;          // auto increment aktif
    protected $keyType = 'int';           // tipe primary key

    protected $fillable = ['nama', 'tb', 'bb', 'admin_id']; // jangan tulis PK di sini

    // Relasi ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
