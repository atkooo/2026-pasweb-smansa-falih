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
        Schema::table('jadwal', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['tanggal_kegiatan', 'waktu', 'tempat']);

            // Tambah kolom deskripsi
            $table->text('deskripsi')->nullable()->after('nama_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn('deskripsi');

            $table->date('tanggal_kegiatan')->after('nama_kegiatan');
            $table->time('waktu')->after('tanggal_kegiatan');
            $table->string('tempat')->after('waktu');
        });
    }
};
