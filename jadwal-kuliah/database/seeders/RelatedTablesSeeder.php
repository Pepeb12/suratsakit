<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelatedTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Ruang
        $ruangs = [
            ['kode_ruang' => 'A211', 'nama_ruang' => 'Ruang A211', 'kapasitas' => 40],
            ['kode_ruang' => 'A204', 'nama_ruang' => 'Ruang A204', 'kapasitas' => 35],
            ['kode_ruang' => 'A205', 'nama_ruang' => 'Ruang A205', 'kapasitas' => 45],
            ['kode_ruang' => 'B301', 'nama_ruang' => 'Ruang B301', 'kapasitas' => 30],
            ['kode_ruang' => 'B302', 'nama_ruang' => 'Lab Komputer B302', 'kapasitas' => 30],
            ['kode_ruang' => 'B303', 'nama_ruang' => 'Lab Komputer B303', 'kapasitas' => 30],
            ['kode_ruang' => 'LAB-JRG', 'nama_ruang' => 'Lab Jaringan', 'kapasitas' => 25],
            ['kode_ruang' => 'A209', 'nama_ruang' => 'Ruang A209', 'kapasitas' => 40],
            ['kode_ruang' => 'AULA', 'nama_ruang' => 'Aula', 'kapasitas' => 200],
        ];

        foreach ($ruangs as $ruang) {
            DB::table('ruang')->insert(array_merge($ruang, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Dosen
        $dosens = [
            ['nip' => 'NIP001', 'nama_dosen' => 'Dr. Latifah Wulandari', 'gelar' => 'S.E, M.M'],
            ['nip' => 'NIP002', 'nama_dosen' => 'Dr. Yudhy', 'gelar' => 'M.Ag'],
            ['nip' => 'NIP003', 'nama_dosen' => 'Armansyah Sarusu', 'gelar' => 'S.Sos., M.Si'],
            ['nip' => 'NIP004', 'nama_dosen' => 'Yelly A M Salam', 'gelar' => 'Dra, M.M'],
            ['nip' => 'NIP005', 'nama_dosen' => 'Encep Supriatha', 'gelar' => 'SE., S.Kom, M.Kom'],
            ['nip' => 'NIP006', 'nama_dosen' => 'Kanda M Ishak', 'gelar' => 'M.Kom'],
            ['nip' => 'NIP007', 'nama_dosen' => 'Nova Indrayana Yusman', 'gelar' => 'M.Kom'],
            ['nip' => 'NIP008', 'nama_dosen' => 'Iim', 'gelar' => 'M.Kom'],
            ['nip' => 'NIP009', 'nama_dosen' => 'Haekal Pirous', 'gelar' => 'S.T., M.A.B'],
            ['nip' => 'NIP010', 'nama_dosen' => 'Muhamad Furqon', 'gelar' => 'M.Kom'],
            ['nip' => 'NIP011', 'nama_dosen' => 'Tedi Budiman', 'gelar' => 'S.Si., M.Kom'],
            ['nip' => 'NIP012', 'nama_dosen' => 'Riyadh Ahsanul Arifin', 'gelar' => 'M.pd'],
            ['nip' => 'NIP013', 'nama_dosen' => 'Dr. H... Marian', 'gelar' => 'M.Eng.Sc'],
            ['nip' => 'NIP014', 'nama_dosen' => 'Kelompok Studi Islam', 'gelar' => ''],
        ];

        foreach ($dosens as $dosen) {
            DB::table('dosen')->insert(array_merge($dosen, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Mata Kuliah
        $mataKuliahs = [
            ['kode_mk' => 'MK001', 'nama_mk' => 'Pengantar Akuntansi', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK002', 'nama_mk' => 'Pendidikan Agama Islam I', 'sks' => 2, 'semester' => '1'],
            ['kode_mk' => 'MK003', 'nama_mk' => 'Pengantar Manajemen & Bisnis', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK004', 'nama_mk' => 'Pengantar Manajemen', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK005', 'nama_mk' => 'FPN I (MS Office)', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK006', 'nama_mk' => 'Program Niaga I (MS Office)', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK007', 'nama_mk' => 'Pengantar Sistem & Teknologi Info', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK008', 'nama_mk' => 'Matematika Informatika', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK009', 'nama_mk' => 'KPAH-I', 'sks' => 2, 'semester' => '1'],
            ['kode_mk' => 'MK010', 'nama_mk' => 'Logika dan Algoritma', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK011', 'nama_mk' => 'Bahasa Inggris I (For Computer)', 'sks' => 2, 'semester' => '1'],
            ['kode_mk' => 'MK012', 'nama_mk' => 'Aljabar Linier (Vektor & Matrix)', 'sks' => 3, 'semester' => '1'],
            ['kode_mk' => 'MK013', 'nama_mk' => 'KJP', 'sks' => 1, 'semester' => '1'],
        ];

        foreach ($mataKuliahs as $mk) {
            DB::table('mata_kuliah')->insert(array_merge($mk, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Shift
        $shifts = [
            ['kode_shift' => 'D3-KA', 'nama_shift' => 'D3 Komputer Akuntansi', 'program_studi' => 'D3 KA'],
            ['kode_shift' => 'S1-BDA', 'nama_shift' => 'S1 Bisnis Digital A', 'program_studi' => 'S1 BD'],
            ['kode_shift' => 'S1-BDB', 'nama_shift' => 'S1 Bisnis Digital B', 'program_studi' => 'S1 BD'],
            ['kode_shift' => 'ALL', 'nama_shift' => 'Semua Kelas', 'program_studi' => 'ALL'],
        ];

        foreach ($shifts as $shift) {
            DB::table('shift')->insert(array_merge($shift, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Seed Jadwal with relations
        $jadwals = [
            // Senin
            ['hari' => 'Senin', 'waktu' => '07:30-09:10', 'mata_kuliah_id' => 1, 'dosen_id' => 1, 'ruang_id' => 1, 'shift_id' => 1],
            ['hari' => 'Senin', 'waktu' => '09:00-10:40', 'mata_kuliah_id' => 2, 'dosen_id' => 2, 'ruang_id' => 2, 'shift_id' => 1],
            ['hari' => 'Senin', 'waktu' => '07:30-10:00', 'mata_kuliah_id' => 3, 'dosen_id' => 3, 'ruang_id' => 3, 'shift_id' => 2],
            
            // Selasa
            ['hari' => 'Selasa', 'waktu' => '08:20-10:00', 'mata_kuliah_id' => 4, 'dosen_id' => 4, 'ruang_id' => 7, 'shift_id' => 1],
            ['hari' => 'Selasa', 'waktu' => '10:20-12:00', 'mata_kuliah_id' => 5, 'dosen_id' => 5, 'ruang_id' => 6, 'shift_id' => 1],
            ['hari' => 'Selasa', 'waktu' => '07:30-10:00', 'mata_kuliah_id' => 6, 'dosen_id' => 6, 'ruang_id' => 5, 'shift_id' => 2],
            ['hari' => 'Selasa', 'waktu' => '13:00-14:40', 'mata_kuliah_id' => 7, 'dosen_id' => 7, 'ruang_id' => 7, 'shift_id' => 1],
            
            // Rabu
            ['hari' => 'Rabu', 'waktu' => '08:20-10:00', 'mata_kuliah_id' => 8, 'dosen_id' => 8, 'ruang_id' => 4, 'shift_id' => 1],
            ['hari' => 'Rabu', 'waktu' => '10:10-11:00', 'mata_kuliah_id' => 9, 'dosen_id' => 9, 'ruang_id' => 9, 'shift_id' => 1],
            ['hari' => 'Rabu', 'waktu' => '13:00-15:30', 'mata_kuliah_id' => 5, 'dosen_id' => 5, 'ruang_id' => 6, 'shift_id' => 1],
            ['hari' => 'Rabu', 'waktu' => '08:20-10:00', 'mata_kuliah_id' => 7, 'dosen_id' => 10, 'ruang_id' => 3, 'shift_id' => 2],
            
            // Kamis
            ['hari' => 'Kamis', 'waktu' => '07:30-10:00', 'mata_kuliah_id' => 10, 'dosen_id' => 11, 'ruang_id' => 8, 'shift_id' => 1],
            ['hari' => 'Kamis', 'waktu' => '10:10-11:50', 'mata_kuliah_id' => 11, 'dosen_id' => 12, 'ruang_id' => 8, 'shift_id' => 1],
            ['hari' => 'Kamis', 'waktu' => '13:00-14:40', 'mata_kuliah_id' => 12, 'dosen_id' => 13, 'ruang_id' => 8, 'shift_id' => 1],
            
            // Jumat
            ['hari' => 'Jumat', 'waktu' => '07:30-09:00', 'mata_kuliah_id' => 13, 'dosen_id' => 14, 'ruang_id' => 9, 'shift_id' => 4],
        ];

        foreach ($jadwals as $jadwal) {
            DB::table('jadwal')->insert(array_merge($jadwal, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
