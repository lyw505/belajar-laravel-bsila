<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kbm extends Model
{
    use HasFactory;
     protected $table = 'datakbm';
    protected $fillable = [
        'idguru',
        'idwalas',
        'hari',
        'mulai',
        'selesai',
    ];

    public function guru()
    {
        // FK di tabel datakbm adalah idguru, PK di dataguru adalah idguru
        return $this->belongsTo(guru::class, 'idguru', 'idguru');
    }
    public function walas()
    {
        // FK di datakbm adalah idwalas, PK di datawalas adalah idwalas
        return $this->belongsTo(walas::class, 'idwalas', 'idwalas');
    }
    
}
