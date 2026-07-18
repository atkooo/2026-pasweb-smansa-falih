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
        Schema::table('formulir_pendaftaran', function (Blueprint $table) {
            $table->string('nama_ayah')->nullable()->after('motto_hidup');
            $table->string('pekerjaan_ayah')->nullable()->after('nama_ayah');
            $table->string('nama_ibu')->nullable()->after('pekerjaan_ayah');
            $table->string('pekerjaan_ibu')->nullable()->after('nama_ibu');
            $table->string('nama_wali')->nullable()->after('pekerjaan_ibu');
            $table->string('no_telp_ortu')->nullable()->after('nama_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulir_pendaftaran', function (Blueprint $table) {
            $table->dropColumn([
                'nama_ayah',
                'pekerjaan_ayah',
                'nama_ibu',
                'pekerjaan_ibu',
                'nama_wali',
                'no_telp_ortu'
            ]);
        });
    }
};
