# 📁 SEMUA FILE PHP YANG DIBUAT

## Ringkasan File
Total: **10 file PHP utama**

### Routes (1 file)
- `routes/web.php`

### Controllers (1 file)
- `app/Http/Controllers/JadwalController.php`

### Models (5 files)
- `app/Models/Jadwal.php`
- `app/Models/Ruang.php`
- `app/Models/Dosen.php`
- `app/Models/MataKuliah.php`
- `app/Models/Shift.php`

### Migrations (2 files)
- `database/migrations/2025_10_23_092254_create_jadwal_table.php`
- `database/migrations/2025_10_23_092642_create_related_tables_for_jadwal.php`

### Seeders (2 files)
- `database/seeders/JadwalSeeder.php`
- `database/seeders/RelatedTablesSeeder.php`

---

## 1️⃣ ROUTES - web.php

**File:** `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('jadwal.index');
});

Route::get('/jadwal', [JadwalController::class, 'index']);
```

---

## 2️⃣ CONTROLLER - JadwalController.php

**File:** `app/Http/Controllers/JadwalController.php`

```php
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
```

---

## 3️⃣ MODELS

### Model: Jadwal.php

**File:** `app/Models/Jadwal.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    
    protected $fillable = [
        'hari',
        'waktu',
        'mata_kuliah_id',
        'dosen_id',
        'ruang_id',
        'shift_id',
    ];

    // Relations
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
```

### Model: Ruang.php

**File:** `app/Models/Ruang.php`

```php
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
```

### Model: Dosen.php

**File:** `app/Models/Dosen.php`

```php
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
```

### Model: MataKuliah.php

**File:** `app/Models/MataKuliah.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mata_kuliah_id');
    }
}
```

### Model: Shift.php

**File:** `app/Models/Shift.php`

```php
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
```

---

## 4️⃣ MIGRATIONS

### Migration: create_jadwal_table.php (Level 4)

**File:** `database/migrations/2025_10_23_092254_create_jadwal_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('hari', 20);
            $table->string('waktu', 20);
            $table->string('mata_kuliah', 100);
            $table->string('dosen', 100);
            $table->string('ruangan', 20);
            $table->string('kelas', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
```

### Migration: create_related_tables_for_jadwal.php (Level 6)

**File:** `database/migrations/2025_10_23_092642_create_related_tables_for_jadwal.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create ruang table
        Schema::create('ruang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruang', 20)->unique();
            $table->string('nama_ruang', 100);
            $table->integer('kapasitas')->nullable();
            $table->timestamps();
        });

        // Create dosen table
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 50)->unique();
            $table->string('nama_dosen', 100);
            $table->string('gelar', 50)->nullable();
            $table->timestamps();
        });

        // Create mata_kuliah table
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 20)->unique();
            $table->string('nama_mk', 100);
            $table->integer('sks')->default(3);
            $table->string('semester', 10);
            $table->timestamps();
        });

        // Create shift table (kelas)
        Schema::create('shift', function (Blueprint $table) {
            $table->id();
            $table->string('kode_shift', 20)->unique();
            $table->string('nama_shift', 50);
            $table->string('program_studi', 50);
            $table->timestamps();
        });

        // Drop old jadwal table and recreate with foreign keys
        Schema::dropIfExists('jadwal');
        
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('hari', 20);
            $table->string('waktu', 20);
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('ruang_id')->constrained('ruang')->onDelete('cascade');
            $table->foreignId('shift_id')->constrained('shift')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('shift');
        Schema::dropIfExists('mata_kuliah');
        Schema::dropIfExists('dosen');
        Schema::dropIfExists('ruang');
    }
};
```

---

## 5️⃣ SEEDERS

### Seeder: JadwalSeeder.php (Level 4)

**File:** `database/seeders/JadwalSeeder.php`

```php
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
```

### Seeder: RelatedTablesSeeder.php (Level 6)

**File:** `database/seeders/RelatedTablesSeeder.php`

**Catatan:** File ini panjang (136 baris) berisi seeding untuk:
- 9 Ruang
- 14 Dosen
- 13 Mata Kuliah
- 4 Shift
- 15 Jadwal (dengan foreign keys)

Lihat file lengkap di `/workspace/jadwal-kuliah/database/seeders/RelatedTablesSeeder.php`

---

## 📊 SUMMARY

| Kategori | Jumlah File | Keterangan |
|----------|-------------|------------|
| **Routes** | 1 | web.php |
| **Controllers** | 1 | JadwalController |
| **Models** | 5 | Jadwal, Ruang, Dosen, MataKuliah, Shift |
| **Migrations** | 2 | Level 4 & Level 6 |
| **Seeders** | 2 | Level 4 & Level 6 |
| **TOTAL** | **11** | File PHP utama |

---

## 🎯 RELASI ELOQUENT

### Jadwal Model (4 belongsTo)
1. `mataKuliah()` → MataKuliah
2. `dosen()` → Dosen
3. `ruang()` → Ruang
4. `shift()` → Shift

### Other Models (hasMany)
- Ruang → `jadwals()`
- Dosen → `jadwals()`
- MataKuliah → `jadwals()`
- Shift → `jadwals()`

---

**Tanggal:** 23 Oktober 2025  
**Lokasi:** `/workspace/jadwal-kuliah/`  
**Framework:** Laravel 12.x
