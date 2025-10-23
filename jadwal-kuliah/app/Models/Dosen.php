<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    
    protected $fillable = [
        'nip',
        'nama_dosen',
        'gelar',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'dosen_id');
    }
}
