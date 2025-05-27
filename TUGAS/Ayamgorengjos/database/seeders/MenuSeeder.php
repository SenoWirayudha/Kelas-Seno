<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = [
            [
                'nama' => 'Ayam Goreng Original',
                'deskripsi' => 'Ayam goreng renyah dengan bumbu rahasia',
                'harga' => 15000.00,
                'gambar' => 'ayam goreng.jpg',
                'kategori' => 'Ayam Goreng',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ayam Penyet Sambal',
                'deskripsi' => 'Ayam penyet dengan sambal pedas',
                'harga' => 17000.00,
                'gambar' => 'ayam penyet.jpg',
                'kategori' => 'Ayam Penyet',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ayam Bakar Madu',
                'deskripsi' => 'Ayam bakar dengan olesan madu special',
                'harga' => 20000.00,
                'gambar' => 'ayam bakar.webp',
                'kategori' => 'Ayam Bakar',
                'tersedia' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('menu')->insert($menu);
    }
}