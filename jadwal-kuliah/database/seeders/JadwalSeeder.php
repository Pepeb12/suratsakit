<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwals = [
            // Senin
            ['hari' => 'Senin', 'waktu' => '07:30-09:10', 'mata_kuliah' => 'Pengantar Akuntansi', 'dosen' => 'Dr. Latifah Wulandari, S.E, M.M', 'ruangan' => 'A211', 'kelas' => 'D3 KA'],
            ['hari' => 'Senin', 'waktu' => '09:00-10:40', 'mata_kuliah' => 'Pendidikan Agama Islam I', 'dosen' => 'Dr. Yudhy, M.Ag', 'ruangan' => 'A204', 'kelas' => 'D3 KA'],
            ['hari' => 'Senin', 'waktu' => '07:30-10:00', 'mata_kuliah' => 'Pengantar Manajemen & Bisnis', 'dosen' => 'Armansyah Sarusu, S.Sos., M.Si', 'ruangan' => 'A205', 'kelas' => 'S1 BD A'],
            
            // Selasa
            ['hari' => 'Selasa', 'waktu' => '08:20-10:00', 'mata_kuliah' => 'Pengantar Manajemen', 'dosen' => 'Yelly A M Salam, Dra, M.M', 'ruangan' => 'Lab Jaringan', 'kelas' => 'D3 KA'],
            ['hari' => 'Selasa', 'waktu' => '10:20-12:00', 'mata_kuliah' => 'FPN I (MS Office)', 'dosen' => 'Encep Supriatha, SE., S.Kom, M.Kom', 'ruangan' => 'B303', 'kelas' => 'D3 KA'],
            ['hari' => 'Selasa', 'waktu' => '07:30-10:00', 'mata_kuliah' => 'Program Niaga I (MS Office)', 'dosen' => 'Kanda M Ishak, M.Kom', 'ruangan' => 'B302', 'kelas' => 'S1 BD A'],
            ['hari' => 'Selasa', 'waktu' => '13:00-14:40', 'mata_kuliah' => 'Pengantar Sistem & Teknologi Info', 'dosen' => 'Nova Indrayana Yusman, M.Kom', 'ruangan' => 'Lab Jaringan', 'kelas' => 'D3 KA'],
            
            // Rabu
            ['hari' => 'Rabu', 'waktu' => '08:20-10:00', 'mata_kuliah' => 'Matematika Informatika', 'dosen' => 'Iim, M.Kom', 'ruangan' => 'B301', 'kelas' => 'D3 KA'],
            ['hari' => 'Rabu', 'waktu' => '10:10-11:00', 'mata_kuliah' => 'KPAH-I', 'dosen' => 'Haekal Pirous, S.T., M.A.B', 'ruangan' => 'AULA', 'kelas' => 'D3 KA'],
            ['hari' => 'Rabu', 'waktu' => '13:00-15:30', 'mata_kuliah' => 'FPN I (MS Office)', 'dosen' => 'Encep Supriatha, S E, S.Kom, M.M', 'ruangan' => 'B303', 'kelas' => 'D3 KA'],
            ['hari' => 'Rabu', 'waktu' => '08:20-10:00', 'mata_kuliah' => 'Pengantar Sistem & Teknologi Info', 'dosen' => 'Muhamad Furqon, M.Kom', 'ruangan' => 'A205', 'kelas' => 'S1 BD'],
            
            // Kamis
            ['hari' => 'Kamis', 'waktu' => '07:30-10:00', 'mata_kuliah' => 'Logika dan Algoritma', 'dosen' => 'Tedi Budiman, S.Si., M.Kom', 'ruangan' => 'A209', 'kelas' => 'D3 KA'],
            ['hari' => 'Kamis', 'waktu' => '10:10-11:50', 'mata_kuliah' => 'Bahasa Inggris I (For Computer)', 'dosen' => 'Riyadh Ahsanul Arifin, M.pd', 'ruangan' => 'A209', 'kelas' => 'D3 KA'],
            ['hari' => 'Kamis', 'waktu' => '13:00-14:40', 'mata_kuliah' => 'Aljabar Linier (Vektor & Matrix)', 'dosen' => 'Dr. H... Marian, M.Eng.Sc', 'ruangan' => 'A209', 'kelas' => 'D3 KA'],
            
            // Jumat
            ['hari' => 'Jumat', 'waktu' => '07:30-09:00', 'mata_kuliah' => 'KJP', 'dosen' => 'Kelompok Studi Islam', 'ruangan' => '-', 'kelas' => 'ALL'],
        ];

        foreach ($jadwals as $jadwal) {
            DB::table('jadwal')->insert(array_merge($jadwal, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
