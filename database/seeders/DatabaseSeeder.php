<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Divisi;
use App\Models\jenisData;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
                 'nama' => 'ravi',
                 'email' => 'ravioctiannafis@gmail.com',
                 'username' => 'admin',
                 'password' => bcrypt('111111')
             ]);

             User::create([
                'nama' => 'Ketua KPU',
                'email' => 'robert990@gmail.com',
                'username' => 'ketuakpu',
                'password' => bcrypt('password')
            ]);

            Divisi::create([
                'divisi' => 'Data & Informasi'
            ]);
            Divisi::create([
                'divisi' => 'Keuangan'
            ]);
            Divisi::create([
                'divisi' => 'Teknis'
            ]);
            Divisi::create([
                'divisi' => 'Hukum'
            ]);

            jenisData::create([
                'jenis_data' => 'data masuk'
            ]);

            jenisData::create([
                'jenis_data' => 'data keluar'
            ]);

    }
}
