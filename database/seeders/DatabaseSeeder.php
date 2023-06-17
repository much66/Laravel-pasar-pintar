<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Arif Muhamad Rifai',
            'username' => 'arifmuch_66',
            'role' => 'admin',
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'Warung Mang Oleh',
            'username' => 'oleh22',
            'role' => 'pedagang',
            'gender' => 'L',
            'email' => 'oleh22@gmail.com',
            'no_telp' => 6285775849329,
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'Toko Bu Titin',
            'username' => 'titi10',
            'role' => 'pedagang',
            'gender' => 'P',
            'email' => 'titi25@gmail.com',
            'no_telp' => 628215849329,
            'password' => bcrypt('12345'),
        ]);
        User::create([
            'name' => 'Sumiati',
            'username' => 'atiloro',
            'role' => 'pembeli',
            'gender' => 'P',
            'email' => 'yati21@gmail.com',
            'no_telp' => 6285325495532,
            'alamat' => 'Jalan Raya Manado Tomohon (Depan United Tractor)
                        Kelurahan Winangun 1 Kecamatan Malalayang Kota
                        Manado.',
            'saldo' => 1000000,
            'password' => bcrypt('12345'),
        ]);

        Category::create([
            'name' => 'Sayuran',
            'slug' => 'sayuran',
            'icon' => 'fa-carrot',
            'color' => '#ff6600'
        ]);
        Category::create([
            'name' => 'Buah',
            'slug' => 'buah',
            'icon' => 'fa-apple-whole',
            'color' => '#cc0000'
        ]);
        Category::create([
            'name' => 'Daging',
            'slug' => 'daging',
            'icon' => 'fa-drumstick-bite',
            'color' => '#e6b800'
        ]);
        Category::create([
            'name' => 'Seafood',
            'slug' => 'seafood',
            'icon' => 'fa-fish',
            'color' => '#005ce6'
        ]);
        Category::create([
            'name' => 'Bumbu',
            'slug' => 'bumbu',
            'icon' => 'fa-mortar-pestle',
            'color' => '#59b300'
        ]);
        Category::create([
            'name' => 'Bahan Kue',
            'slug' => 'bahan-kue',
            'icon' => 'fa-cake-candles',
            'color' => '#fb3785'
        ]);
        Category::create([
            'name' => 'Minuman',
            'slug' => 'minuman',
            'icon' => 'fa-wine-glass',
            'color' => '#993366'
        ]);
        Category::create([
            'name' => 'Lainnya',
            'slug' => 'lainnya',
            'icon' => 'fa-bread-slice',
            'color' => '#9e7042'
        ]);
        Product::factory(100)->create();
        Type::create([
            'name' => 'Sayur',
            'slug' => 'sayur',
        ]);
        Type::create([
            'name' => 'Gorengan',
            'slug' => 'gorengan',
        ]);
        Type::create([
            'name' => 'Tumis',
            'slug' => 'tumis',
        ]);
        Type::create([
            'name' => 'Jus',
            'slug' => 'jus',
        ]);

        Recipe::factory(50)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
