<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class guru extends Model
{
    use HasFactory;
    protected $table = 'dataguru';
    protected $primaryKey = 'idguru';
    protected $fillable = ['id', 'nama', 'mapel'];

    public function admin()
    {
        return $this->belongsTo(admin::class, 'id');
    }

    public function walas()
    {
        return $this->hasOne(Walas::class, 'idguru', 'idguru');
    }

    public function kbm()
    {
        // Relasi ke datakbm: FK di datakbm = idguru, PK di dataguru = idguru
        return $this->hasMany(kbm::class, 'idguru', 'idguru');
    }
}
