<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Hapus data sebelumnya jika perlu
        // Product::truncate();

        $productNames = ['Brosur', 'Poster', 'Spanduk', 'Kartu Nama', 'Stiker', 'Undangan', 'Banner', 'Buku Nota', 'Kalender', 'Plakat'];
        $sizes = ['A4', 'A3', 'A5', 'F4', 'Letter'];
        $prices = [5000, 10000, 15000, 20000, 25000];

        shuffle($productNames); // Acak agar setiap run berbeda

        foreach ($productNames as $name) {
            Product::firstOrCreate(
                ['name' => "Cetak $name"], // Cek apakah sudah ada
                [
                    'desc' => $faker->sentence(10),
                    'image' => 'noimage.jpg', // Gambar default
                    'sizes' => json_encode($sizes),
                    'prices' => json_encode($prices),
                ]
            );
        }
    }
}
