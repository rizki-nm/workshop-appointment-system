<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Drug;
use App\Models\Patient;
use App\Models\Poli;
use App\Models\ServiceSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('admin');
        $password2 = bcrypt('dokter');
        $password3 = bcrypt('pasien');

        // admin default
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tes.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'is_active' => 1,
            'password' => $password,
            'remember_token' => Str::random(10),
        ]);

        // dokter default
        User::create([
            'name' => 'John',
            'email' => 'dokter@tes.com',
            'email_verified_at' => now(),
            'role' => 'doctor',
            'is_active' => 1,
            'password' => $password2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Doe',
            'email' => 'dokter2@tes.com',
            'email_verified_at' => now(),
            'role' => 'doctor',
            'is_active' => 1,
            'password' => $password2,
            'remember_token' => Str::random(10),
        ]);

        // pasien default
        User::create([
            'name' => 'Pasien',
            'email' => 'pasien@tes.com',
            'email_verified_at' => now(),
            'role' => 'guest',
            'is_active' => 1,
            'password' => $password3,
            'remember_token' => Str::random(10),
        ]);

        Poli::create([
            'name' => 'Umum',
            'description' => 'Poli Umum',
        ]);

        Poli::create([
            'name' => 'Gigi',
            'description' => 'Melayani pasien gigi',
        ]);

        Poli::create([
            'name' => 'KIA',
            'description' => 'Melayani pasien KIA',
        ]);

        Poli::create([
            'name' => 'Mata',
            'description' => 'Melayani pasien mata',
        ]);

        Doctor::create([
            'user_id' => 2,
            'poli_id' => 1,
            'name' => 'John',
            'address' => 'Jl. Dokter',
            'phone_number' => '081234567890',
        ]);

        Doctor::create([
            'user_id' => 3,
            'poli_id' => 2,
            'name' => 'John',
            'address' => 'Jl. Dokter',
            'phone_number' => '081234567890',
        ]);

        Patient::create([
            'user_id' => 4,
            'name' => 'Pasien 1',
            'ktp_number' => '1234567890123456',
            'rm_number' => '2101-001',
            'phone_number' => '081234567890',
            'address' => 'Jl. Pasien 1',
        ]);

        Drug::create([
            'code' => '0001',
            'name' => 'Paracetamol',
            'packaging' => '10',
            'price' => '10000',
            'stock' => '100',
        ]);
    }
}
