<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'datakelas';   // nama tabel
    protected $primaryKey = 'idkelas'; // PK custom
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['idkelas', 'idwalas', 'idsiswa'];

    // Relasi ke Walas
    public function walas()
    {
        return $this->belongsTo(Walas::class, 'idwalas', 'idwalas');
    }

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa', 'idsiswa');
    }
}
