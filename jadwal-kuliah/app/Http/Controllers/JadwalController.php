<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        // Using Eloquent to fetch all jadwal records with relations (Level 6)
        $jadwals = Jadwal::with(['mataKuliah', 'dosen', 'ruang', 'shift'])->get();
        
        return view('jadwal.index', compact('jadwals'));
    }
}
