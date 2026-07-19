<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Demo User (Calon Anggota)
        User::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'nama_lengkap' => 'Kim Jong Unc (Calon Anggota)',
                'password' => Hash::make('password123'),
                'role' => 'calon_anggota',
            ]
        );

        // Another Demo User (Pengurus)
        User::updateOrCreate(
            ['nisn' => '0987654321'],
            [
                'nama_lengkap' => 'Siti Aminah (Pengurus)',
                'password' => Hash::make('password123'),
                'role' => 'pengurus',
            ]
        );

        // Demo User (Anggota Resmi)
        User::updateOrCreate(
            ['nisn' => '1122334455'],
            [
                'nama_lengkap' => 'Budi Santoso (Anggota)',
                'password' => Hash::make('password123'),
                'role' => 'anggota',
            ]
        );
    }
}
