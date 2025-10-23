<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('jadwal.index');
});

Route::get('/jadwal', [JadwalController::class, 'index']);
