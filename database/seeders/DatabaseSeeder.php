<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Divisi;
use App\Models\jenisData;
use App\Models\Ketegori;
use App\Models\Rak;
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
                 'nama' => 'sekretaris',
                 'email' => 'ravioctiannafis@gmail.com',
                 'username' => 'sekre',
                 'password' => bcrypt('111111'),
                 'is_admin' => '2'
             ]);
        User::create([
                 'nama' => 'ravi',
                 'email' => 'ravioctiannafis@gmail.com',
                 'username' => 'admin',
                 'password' => bcrypt('111111'),
                 'is_admin' => '0'
             ]);

             User::create([
                'nama' => 'Ketua KPU',
                'email' => 'robert990@gmail.com',
                'username' => 'ketuakpu',
                'password' => bcrypt('password'),
                'is_admin' => '1'
            ]);

            User::create([
                'nama' => 'staff data',
                'email' => 'ravioctiannafis@gmail.com',
                'username' => 'data',
                'password' => bcrypt('111111'),
                'is_admin' => '3'
            ]);

            User::create([
                'nama' => 'staff hukum',
                'email' => 'ravioctiannafis@gmail.com',
                'username' => 'hukum',
                'password' => bcrypt('111111'),
                'is_admin' => '4'
            ]);

            User::create([
                'nama' => 'staff keuangan',
                'email' => 'ravioctiannafis@gmail.com',
                'username' => 'keuangan',
                'password' => bcrypt('111111'),
                'is_admin' => '5'
            ]);
    

            User::create([
                'nama' => 'staff teknis',
                'email' => 'ravioctiannafis@gmail.com',
                'username' => 'teknis',
                'password' => bcrypt('111111'),
                'is_admin' => '6'
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

            Rak::create([
                'nama_rak' => 'A'
            ]);
            Rak::create([
                'nama_rak' => 'B'
            ]);
            Rak::create([
                'nama_rak' => 'C'
            ]);
            Rak::create([
                'nama_rak' => 'D'
            ]);
            Rak::create([
                'nama_rak' => 'E'
            ]);

            Ketegori::create([
                'kategori_surat' => 'surat undangan'
            ]);

            Ketegori::create([
                'kategori_surat' => 'surat resmi'
            ]);

            Ketegori::create([
                'kategori_surat' => 'surat pemberitahuan'
            ]);

    }
}
