<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        // Admin

        User::create([
            'name'     => 'Admin SIGALANG',
            'no_hp'    => '081234567891',
            'role'     => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Karyawan
        User::create([
            'name'     => 'Karyawan',
            'no_hp'    => '081234567893',
            'role'     => 'karyawan',
            'password' => bcrypt('password'),
        ]);

        // Customer Demo
        User::create([
            'name'     => 'Customer Demo',
            'no_hp'    => '081234567892',
            'role'     => 'customer',
            'password' => bcrypt('password'),
        ]);

        // Lapangan
        \App\Models\Lapangan::create([
            'nama_lapangan' => 'Standard Pro Synthetic',
            'harga' => 150000,
        ]);
        
        // Alat
        \App\Models\Alat::create([
            'nama_alat' => 'Sepatu Futsal',
            'harga_sewa' => 20000,
            'stok' => 10,
        ]);

        \App\Models\Alat::create([
            'nama_alat' => 'Rompi Tim',
            'harga_sewa' => 10000,
            'stok' => 20,
        ]);
    }
}
