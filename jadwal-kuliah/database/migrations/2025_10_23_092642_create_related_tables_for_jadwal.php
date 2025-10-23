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
