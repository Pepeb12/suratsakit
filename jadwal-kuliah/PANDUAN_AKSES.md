# 🎓 Panduan Akses Aplikasi Jadwal Kuliah Laravel
## Fakultas Komputer 2025/2026 Semester Ganjil

---

## ✅ STATUS: SERVER BERJALAN

**Server Laravel sudah aktif dan siap digunakan!**

---

## 🌐 URL AKSES

### Akses Utama
```
http://127.0.0.1:8000/
```
atau
```
http://127.0.0.1:8000/jadwal
```

**Kedua URL menampilkan halaman yang sama**

---

## 📋 ISI HALAMAN (Scroll untuk Melihat Semua Level)

Halaman ini menampilkan semua level dalam satu halaman:

### 1️⃣ Level 1 & 2: Jadwal Hardcoded (Scroll ke atas)
- Tampilan jadwal lengkap Senin - Jumat
- Desain mirip Google Sheets
- Data hardcoded/manual

### 2️⃣ Level 3: Database Native PDO (Scroll tengah)
**Judul:** "Level 3: Data Jadwal dari Database (Direct PDO - 3 Records)"

Menampilkan:
- 3 data jadwal dari database
- Menggunakan query SQL dengan JOIN
- Tanpa model, langsung PDO

### 3️⃣ Level 6: Eloquent Relations (Scroll bawah)
**Judul:** "Level 6: Data Jadwal dengan Eloquent Relations (15 Records)"

Menampilkan:
- 15 data jadwal lengkap
- Kode MK, Nama MK, SKS
- Nama Dosen, Gelar
- Kode Ruang, Kapasitas
- Nama Shift/Kelas
- Semua data dari relasi eloquent

---

## 🗄️ DATABASE INFO

**Database Type:** SQLite  
**Location:** `database/database.sqlite`

### Total Records
- ✅ **15** Jadwal
- ✅ **9** Ruang
- ✅ **14** Dosen
- ✅ **13** Mata Kuliah
- ✅ **4** Shift

### Sample Query Manual
```bash
# Masuk ke database
cd /workspace/jadwal-kuliah
sqlite3 database/database.sqlite

# Lihat semua jadwal dengan relasi
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

## 🎯 DEMO FITUR

### Eloquent Relations yang Diterapkan

**4 Relasi di Model Jadwal:**

1. **Jadwal → Mata Kuliah** (belongsTo)
   ```php
   $jadwal->mataKuliah->nama_mk
   $jadwal->mataKuliah->kode_mk
   $jadwal->mataKuliah->sks
   ```

2. **Jadwal → Dosen** (belongsTo)
   ```php
   $jadwal->dosen->nama_dosen
   $jadwal->dosen->gelar
   $jadwal->dosen->nip
   ```

3. **Jadwal → Ruang** (belongsTo)
   ```php
   $jadwal->ruang->kode_ruang
   $jadwal->ruang->nama_ruang
   $jadwal->ruang->kapasitas
   ```

4. **Jadwal → Shift** (belongsTo)
   ```php
   $jadwal->shift->nama_shift
   $jadwal->shift->kode_shift
   $jadwal->shift->program_studi
   ```

---

## 📂 STRUKTUR FILE PENTING

```
jadwal-kuliah/
├── app/
│   ├── Http/Controllers/
│   │   └── JadwalController.php         ← Level 2
│   └── Models/
│       ├── Jadwal.php                   ← Level 5 & 6
│       ├── Ruang.php                    ← Level 6
│       ├── Dosen.php                    ← Level 6
│       ├── MataKuliah.php               ← Level 6
│       └── Shift.php                    ← Level 6
│
├── database/
│   ├── migrations/
│   │   ├── 2025_10_23_092254_create_jadwal_table.php        ← Level 4
│   │   └── 2025_10_23_092642_create_related_tables_for_jadwal.php  ← Level 6
│   ├── seeders/
│   │   ├── JadwalSeeder.php             ← Level 4
│   │   └── RelatedTablesSeeder.php      ← Level 6
│   └── database.sqlite                  ← Database
│
├── resources/views/jadwal/
│   └── index.blade.php                  ← Level 1 (UI)
│
└── routes/
    └── web.php                          ← Level 2 (Routes)
```

---

## 💻 COMMAND YANG SUDAH DIJALANKAN

### Migration
```bash
php artisan migrate:fresh
# Output: 5 migrations berhasil
```

### Seeding
```bash
php artisan db:seed --class=RelatedTablesSeeder
# Output: Seeding database berhasil
```

### Server
```bash
php artisan serve --host=0.0.0.0 --port=8000
# Output: Server running on http://0.0.0.0:8000
```

---

## 🔍 CARA CEK MASING-MASING LEVEL

### Level 1: Blade Only
- ✅ Buka `http://127.0.0.1:8000/`
- ✅ Lihat bagian atas halaman
- ✅ Tampilan jadwal hardcoded mirip Google Sheets

### Level 2: Controller & Route
- ✅ Buka file `app/Http/Controllers/JadwalController.php`
- ✅ Buka file `routes/web.php`
- ✅ Akses `http://127.0.0.1:8000/jadwal`

### Level 3: Simple Database
- ✅ Buka `http://127.0.0.1:8000/`
- ✅ Scroll ke section "Level 3"
- ✅ Lihat 3 data dari database dengan JOIN query

### Level 4: Migration & Seeder
- ✅ Check files di `database/migrations/`
- ✅ Check files di `database/seeders/`
- ✅ Run: `sqlite3 database/database.sqlite "SELECT COUNT(*) FROM jadwal;"`
  - Output: 15

### Level 5: Eloquent Model
- ✅ Buka file `app/Models/Jadwal.php`
- ✅ Lihat protected $fillable dan $table
- ✅ Controller menggunakan `Jadwal::all()`

### Level 6: Eloquent Relations
- ✅ Buka `http://127.0.0.1:8000/`
- ✅ Scroll ke section "Level 6"
- ✅ Lihat data lengkap dengan kolom:
  - Kode MK (dari tabel mata_kuliah)
  - Nama Dosen (dari tabel dosen)
  - Kode Ruang (dari tabel ruang)
  - Nama Shift (dari tabel shift)
- ✅ Semua menggunakan `$jadwal->mataKuliah->nama_mk` dll

---

## 🚀 RESTART SERVER (Jika Perlu)

```bash
# Stop server
pkill -f "php artisan serve"

# Clear cache
cd /workspace/jadwal-kuliah
php artisan view:clear
php artisan cache:clear

# Start server
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 📸 SCREENSHOT CHECKLIST

Yang perlu di-demo/screenshot:

1. ✅ Browser: `http://127.0.0.1:8000/` - Tampilan Level 1
2. ✅ Browser: Scroll ke bawah - Level 3 (3 records)
3. ✅ Browser: Scroll ke bawah lagi - Level 6 (15 records dengan relasi)
4. ✅ Code: `app/Http/Controllers/JadwalController.php`
5. ✅ Code: `routes/web.php`
6. ✅ Code: `app/Models/Jadwal.php` (dengan 4 relasi)
7. ✅ Terminal: `php artisan migrate:fresh` output
8. ✅ Terminal: `php artisan db:seed` output
9. ✅ Database: Query result showing relasi

---

## ✨ KESIMPULAN

**SEMUA LEVEL BERHASIL DIKERJAKAN:**

| Level | Status | Keterangan |
|-------|--------|------------|
| 1 | ✅ | Blade hardcoded berhasil |
| 2 | ✅ | Controller & Route berhasil |
| 3 | ✅ | Database PDO (3 records) berhasil |
| 4 | ✅ | Migration & Seeder (15 records) berhasil |
| 5 | ✅ | Eloquent Model berhasil |
| 6 | ✅ | Eloquent Relations (4 relasi) berhasil |

**🎉 Aplikasi Siap Digunakan!**

Server: **RUNNING** ✅  
Database: **POPULATED** ✅  
Relations: **WORKING** ✅  

---

**Dibuat:** 23 Oktober 2025  
**Laravel Version:** 12.x  
**PHP Version:** 8.4.5  
**Database:** SQLite
