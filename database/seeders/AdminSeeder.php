<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(
            ['nisn' => '9932199312038122'],
            [
                'nama_lengkap' => 'Administrator Paskibra',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
