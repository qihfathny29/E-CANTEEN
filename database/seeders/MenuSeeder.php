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
            ['nama_menu' => 'Nasi Goreng Gila',       'harga' => 12000, 'stock' => 15, 'kategori' => 'makanan_utama', 'is_pedas' => true],
            ['nama_menu' => 'Mie Ayam Jamur',          'harga' => 10000, 'stock' => 20, 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Nasi Uduk Komplit',       'harga' => 13000, 'stock' => 10, 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Ayam Geprek Sambal Ijo',  'harga' => 18000, 'stock' => 12, 'kategori' => 'makanan_utama', 'is_pedas' => true],
            ['nama_menu' => 'Bakso Urat',              'harga' => 12000, 'stock' =>  8, 'kategori' => 'makanan_utama', 'is_pedas' => false],
            ['nama_menu' => 'Soto Ayam',               'harga' => 11000, 'stock' =>  0, 'kategori' => 'makanan_utama', 'is_pedas' => false],
            // Minuman
            ['nama_menu' => 'Es Teh Manis',            'harga' =>  5000, 'stock' => 30, 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Es Jeruk',                'harga' =>  6000, 'stock' => 25, 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Jus Alpukat',             'harga' =>  8000, 'stock' => 10, 'kategori' => 'minuman',       'is_pedas' => false],
            ['nama_menu' => 'Air Mineral',             'harga' =>  3000, 'stock' => 50, 'kategori' => 'minuman',       'is_pedas' => false],
            // Cemilan
            ['nama_menu' => 'Pisang Goreng',           'harga' =>  5000, 'stock' => 20, 'kategori' => 'cemilan',       'is_pedas' => false],
            ['nama_menu' => 'Tahu Crispy Pedas',       'harga' =>  6000, 'stock' => 15, 'kategori' => 'cemilan',       'is_pedas' => true],
            ['nama_menu' => 'Risoles Mayo',            'harga' =>  4000, 'stock' =>  0, 'kategori' => 'cemilan',       'is_pedas' => false],
            // Spesial Promo
            ['nama_menu' => 'Paket Hemat Siang',       'harga' => 15000, 'stock' =>  5, 'kategori' => 'spesial_promo', 'is_pedas' => false],
            ['nama_menu' => 'Combo Ayam + Es Teh',     'harga' => 20000, 'stock' =>  5, 'kategori' => 'spesial_promo', 'is_pedas' => true],
        ];

        foreach ($menus as $item) {
            Menu::create($item);
        }
    }
}
