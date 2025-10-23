<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $table = 'ruang';
    
    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'ruang_id');
    }
}
