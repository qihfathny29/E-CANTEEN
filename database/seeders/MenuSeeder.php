<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Makanan Utama
            ['nama_menu' => 'Nasi Goreng Gila',       'harga' => 12000, 'status' => 'tersedia', 'kategori' => 'makanan_utama', 'is_pedas' => true],
            ['nama_menu' => 'Mie Ayam Jamur',          'harga' => 10000, 'status' => 'tersedia', 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Nasi Uduk Komplit',       'harga' => 13000, 'status' => 'tersedia', 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Ayam Geprek Sambal Ijo',  'harga' => 18000, 'status' => 'tersedia', 'kategori' => 'makanan_utama', 'is_pedas' => true],
            ['nama_menu' => 'Bakso Urat',              'harga' => 12000, 'status' => 'tersedia', 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Soto Ayam',               'harga' => 11000, 'status' => 'habis',    'kategori' => 'makanan_utama', 'is_pedas' => false],
            // Minuman
            ['nama_menu' => 'Es Teh Manis',            'harga' =>  5000, 'status' => 'tersedia', 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Es Jeruk',                'harga' =>  6000, 'status' => 'tersedia', 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Jus Alpukat',             'harga' =>  8000, 'status' => 'tersedia', 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Air Mineral',             'harga' =>  3000, 'status' => 'tersedia', 'kategori' => 'minuman',       'is_pedas' => false],
            // Cemilan
            ['nama_menu' => 'Pisang Goreng',           'harga' =>  5000, 'status' => 'tersedia', 'kategori' => 'cemilan',       'is_pedas' => false],
            ['nama_menu' => 'Tahu Crispy Pedas',       'harga' =>  6000, 'status' => 'tersedia', 'kategori' => 'cemilan',       'is_pedas' => true],
            ['nama_menu' => 'Risoles Mayo',            'harga' =>  4000, 'status' => 'tersedia', 'kategori' => 'cemilan',       'is_pedas' => false],
            // Spesial Promo
            ['nama_menu' => 'Paket Hemat Siang',       'harga' => 15000, 'status' => 'tersedia', 'kategori' => 'spesial_promo', 'is_pedas' => false],
            ['nama_menu' => 'Combo Ayam + Es Teh',     'harga' => 20000, 'status' => 'tersedia', 'kategori' => 'spesial_promo', 'is_pedas' => true],
        ];

        foreach ($menus as $item) {
            Menu::create($item);
        }
    }
}
