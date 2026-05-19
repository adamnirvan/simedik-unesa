<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==================== Seed Polis ====================
        $polis = [
            [
                'nama_poli' => 'Poli Umum',
            ],
            [
                'nama_poli' => 'Poli Gigi',
            ],
            [
                'nama_poli' => 'Poli Anak',
            ],
        ];

        foreach ($polis as $poli) {
            Poli::create($poli);
        }

        // ==================== Seed Medicines ====================
        $medicines = [
            [
                'nama_obat' => 'Paracetamol 500mg',
                'harga' => 5000,
            ],
            [
                'nama_obat' => 'Ibuprofen 400mg',
                'harga' => 7500,
            ],
            [
                'nama_obat' => 'Amoxicillin 500mg',
                'harga' => 15000,
            ],
            [
                'nama_obat' => 'Vitamin C 1000mg',
                'harga' => 25000,
            ],
            [
                'nama_obat' => 'Cough Syrup',
                'harga' => 12000,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }

        // ==================== Seed Users ====================

        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@simedik.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Doctor Users (dengan poli_id)
        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'doctor1@simedik.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'poli_id' => 1, // Poli Umum
        ]);

        User::create([
            'name' => 'Dr. Siti Nurhaliza',
            'email' => 'doctor2@simedik.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'poli_id' => 2, // Poli Gigi
        ]);

        // Patient User
        User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'patient@simedik.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
        ]);
    }
}
