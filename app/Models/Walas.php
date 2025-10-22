<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walas extends Model
{
    use HasFactory;

    protected $table = 'datawalas';   // kasih tau nama tabel
    protected $primaryKey = 'idwalas'; // custom PK
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['idwalas', 'jenjang', 'namakelas', 'tahunajaran', 'idguru'];

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru', 'idguru');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'idwalas', 'idwalas');
    }

    public function kbm()
    {
        return $this->hasMany(kbm::class);
    }
}
