<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Memanggil model User bawaan Laravel
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Data Akun Anda
        User::create([
            'name' => 'Admin Dian',
            'email' => 'lestarinadian1212@gmail.com', // Ganti dengan email Anda
            'password' => Hash::make('kamusbali123'), // Kata sandi akan dienkripsi
        ]);

        // 2. Data Akun Pemilik Kamus
        User::create([
            'name' => 'Pemilik Kamus',
            'email' => 'pemilik@gmail.com', // Ganti dengan email pemilik kamus
            'password' => Hash::make('kamusbali123'), // Kata sandi untuk pemilik kamus
        ]);
    }
}