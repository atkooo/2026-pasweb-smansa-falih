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
            // Using DB statement for simplicity in changing Enum to Varchar
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE formulir_pendaftaran MODIFY status_pendaftaran VARCHAR(255) DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formulir_pendaftaran', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE formulir_pendaftaran MODIFY status_pendaftaran ENUM('pending', 'verified', 'rejected') DEFAULT 'pending'");
        });
    }
};
