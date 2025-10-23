# Aplikasi Jadwal Kuliah - Laravel Full Stack
## Fakultas Komputer 2025/2026 Semester Ganjil

Dokumentasi lengkap dari Level 1 sampai Level 6

---

## Level 1: Blade Only (Hardcoded)

### Deskripsi
Membuat tampilan jadwal kuliah mirip Google Sheets dengan konten hardcoded (fixed, manual typing).

### File Blade
**Lokasi:** `resources/views/jadwal/index.blade.php`

### Screenshot Akses
- URL: `http://127.0.0.1:8000/`
- Menampilkan jadwal lengkap untuk 5 hari (Senin - Jumat)
- Tampilan mirip Google Sheets dengan warna dan styling yang sesuai

### Fitur UI
- Tabel terstruktur dengan header hari
- Section header untuk D3 KA dan S1 BD
- Color coding untuk mata kuliah, dosen, dan ruangan
- Responsive design dengan scroll horizontal

---

## Level 2: Route dan Controller

### File Route
**Lokasi:** `routes/web.php`

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('jadwal.index');
});

Route::get('/jadwal', [JadwalController::class, 'index']);
```

### File Controller
**Lokasi:** `app/Http/Controllers/JadwalController.php`

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

### Screenshot Akses
- URL: `http://127.0.0.1:8000/jadwal`
- Sama dengan Level 1, tapi melalui controller

---

## Level 3: Simple Database (Native PHP)

### Tabel Database
**Nama Tabel:** `jadwal`

**Struktur:**
```sql
CREATE TABLE jadwal (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    hari VARCHAR(20),
    waktu VARCHAR(20),
    mata_kuliah VARCHAR(100),
    dosen VARCHAR(100),
    ruangan VARCHAR(20),
    kelas VARCHAR(20),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Data (3 Records)
```sql
INSERT INTO jadwal VALUES
(1, 'Senin', '07:30-09:10', 'Pengantar Akuntansi', 'Dr. Latifah Wulandari, S.E, M.M', 'A211', 'D3 KA'),
(2, 'Senin', '09:00-10:40', 'Pendidikan Agama Islam I', 'Dr. Yudhy, M.Ag', 'A204', 'D3 KA'),
(3, 'Selasa', '08:20-10:00', 'Pengantar Manajemen', 'Yelly A M Salam, Dra, M.M', 'Lab Jaringan', 'D3 KA');
```

### Implementasi di Blade
Menggunakan PDO langsung di blade (tanpa model, controller):

```php
@php
    $db = new PDO('sqlite:' . database_path('database.sqlite'));
    $stmt = $db->query('SELECT * FROM jadwal LIMIT 3');
    $jadwals_pdo = $stmt->fetchAll(PDO::FETCH_ASSOC);
@endphp
```

### Screenshot
Tampil di bagian bawah halaman dengan judul "Level 3: Data Jadwal dari Database (Direct PDO - 3 Records)"

---

## Level 4: Migration dan Seeder

### Migration File
**Lokasi:** `database/migrations/2025_10_23_092254_create_jadwal_table.php`

```php
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
```

### Seeder File
**Lokasi:** `database/seeders/JadwalSeeder.php`

**Data:** 15 jadwal records untuk berbagai hari dan kelas

### Command Eksekusi
```bash
# Jalankan migration
php artisan migrate:fresh

# Output:
#   INFO  Running migrations.
#   2025_10_23_092254_create_jadwal_table ........... DONE

# Jalankan seeder
php artisan db:seed --class=JadwalSeeder

# Output:
#   INFO  Seeding database.

# Verifikasi
sqlite3 database/database.sqlite "SELECT COUNT(*) FROM jadwal;"
# Output: 15
```

### Screenshot Terminal
- Migration berhasil
- Seeder berhasil
- Tabel terisi 15 data

---

## Level 5: Eloquent Model

### Model File
**Lokasi:** `app/Models/Jadwal.php`

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

### Penggunaan Eloquent di Controller
```php
$jadwals = Jadwal::all();
```

### Tampilan di Blade
```php
@foreach($jadwals as $jadwal)
    <td>{{ $jadwal->mata_kuliah }}</td>
    <td>{{ $jadwal->dosen }}</td>
@endforeach
```

---

## Level 6: Eloquent Relations

### Database Schema dengan Relasi

#### 1. Tabel Ruang
```php
Schema::create('ruang', function (Blueprint $table) {
    $table->id();
    $table->string('kode_ruang', 20)->unique();
    $table->string('nama_ruang', 100);
    $table->integer('kapasitas')->nullable();
    $table->timestamps();
});
```

#### 2. Tabel Dosen
```php
Schema::create('dosen', function (Blueprint $table) {
    $table->id();
    $table->string('nip', 50)->unique();
    $table->string('nama_dosen', 100);
    $table->string('gelar', 50)->nullable();
    $table->timestamps();
});
```

#### 3. Tabel Mata Kuliah
```php
Schema::create('mata_kuliah', function (Blueprint $table) {
    $table->id();
    $table->string('kode_mk', 20)->unique();
    $table->string('nama_mk', 100);
    $table->integer('sks')->default(3);
    $table->string('semester', 10);
    $table->timestamps();
});
```

#### 4. Tabel Shift (Kelas)
```php
Schema::create('shift', function (Blueprint $table) {
    $table->id();
    $table->string('kode_shift', 20)->unique();
    $table->string('nama_shift', 50);
    $table->string('program_studi', 50);
    $table->timestamps();
});
```

#### 5. Tabel Jadwal (Updated dengan Foreign Keys)
```php
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
```

### Relasi di Model

#### Model Jadwal
```php
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
```

### Penggunaan Eloquent Relations

#### Di Controller (Eager Loading)
```php
$jadwals = Jadwal::with(['mataKuliah', 'dosen', 'ruang', 'shift'])->get();
```

#### Di Blade
```php
@foreach($jadwals as $jadwal)
    <td>{{ $jadwal->mataKuliah->kode_mk }}</td>
    <td>{{ $jadwal->mataKuliah->nama_mk }}</td>
    <td>{{ $jadwal->mataKuliah->sks }}</td>
    <td>{{ $jadwal->dosen->nama_dosen }}</td>
    <td>{{ $jadwal->dosen->gelar }}</td>
    <td>{{ $jadwal->ruang->kode_ruang }}</td>
    <td>{{ $jadwal->ruang->kapasitas }}</td>
    <td>{{ $jadwal->shift->nama_shift }}</td>
@endforeach
```

### Data Seeder

**Total Data:**
- 15 Jadwal records
- 9 Ruang records
- 14 Dosen records
- 13 Mata Kuliah records
- 4 Shift records

### Screenshot Browser
Tampilan Level 6 menunjukkan:
- Kode MK dari tabel mata_kuliah
- Nama MK dan SKS dari relasi
- Nama Dosen dan Gelar dari tabel dosen
- Kode Ruang dan Kapasitas dari tabel ruang
- Nama Shift dari tabel shift

---

## Cara Menjalankan Aplikasi

### 1. Start Server
```bash
cd /workspace/jadwal-kuliah
php artisan serve
```

### 2. Akses URL
- **Level 1-2:** `http://127.0.0.1:8000/` atau `http://127.0.0.1:8000/jadwal`
- Scroll ke bawah untuk melihat Level 3 (Direct PDO)
- Scroll lebih ke bawah untuk Level 6 (Eloquent Relations)

### 3. Database
```bash
# Cek isi database
sqlite3 database/database.sqlite

# Query examples
SELECT * FROM jadwal;
SELECT * FROM ruang;
SELECT * FROM dosen;
SELECT * FROM mata_kuliah;
SELECT * FROM shift;

# Join query
SELECT 
    j.hari, 
    j.waktu, 
    mk.nama_mk, 
    d.nama_dosen, 
    r.kode_ruang, 
    s.nama_shift
FROM jadwal j
JOIN mata_kuliah mk ON j.mata_kuliah_id = mk.id
JOIN dosen d ON j.dosen_id = d.id
JOIN ruang r ON j.ruang_id = r.id
JOIN shift s ON j.shift_id = s.id;
```

---

## File Structure

```
jadwal-kuliah/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── JadwalController.php
│   └── Models/
│       ├── Jadwal.php
│       ├── Ruang.php
│       ├── Dosen.php
│       ├── MataKuliah.php
│       └── Shift.php
├── database/
│   ├── migrations/
│   │   ├── 2025_10_23_092254_create_jadwal_table.php
│   │   └── 2025_10_23_092642_create_related_tables_for_jadwal.php
│   ├── seeders/
│   │   ├── JadwalSeeder.php
│   │   └── RelatedTablesSeeder.php
│   └── database.sqlite
├── resources/
│   └── views/
│       └── jadwal/
│           └── index.blade.php
└── routes/
    └── web.php
```

---

## Kesimpulan

✅ **Level 1:** Blade hardcoded berhasil - tampilan mirip Google Sheets  
✅ **Level 2:** Controller dan Route berhasil  
✅ **Level 3:** Database native PHP (PDO) berhasil - 3 records  
✅ **Level 4:** Migration dan Seeder berhasil - 15 records  
✅ **Level 5:** Eloquent Model berhasil - clean code dengan Eloquent::all()  
✅ **Level 6:** Eloquent Relations berhasil - 4 relasi (ruang, dosen, mata_kuliah, shift)  

Semua level telah dikerjakan dengan lengkap dan dapat diakses melalui browser!
