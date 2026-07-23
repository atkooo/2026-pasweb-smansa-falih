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
        Schema::create('formulir_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nama_panggilan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->text('riwayat_penyakit')->nullable();
            $table->string('cita_cita');
            $table->text('keterampilan')->nullable();
            $table->text('ekskul_lain')->nullable();
            $table->text('motivasi');
            $table->string('opsi_pilihan');
            $table->string('motto_hidup');
            $table->string('upload_surat_izin');
            $table->string('upload_skd');
            $table->string('upload_kk');
            $table->string('status_pendaftaran')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formulir_pendaftaran');
    }
};
