<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shift';
    
    protected $fillable = [
        'kode_shift',
        'nama_shift',
        'program_studi',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'shift_id');
    }
}
