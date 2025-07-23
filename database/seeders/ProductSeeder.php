<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Clear existing products
        // DB::table('products')->truncate();

        // Get category IDs
        $indoorCategory = DB::table('categories')->where('name', 'Indoor')->first()->id;
        $outdoorCategory = DB::table('categories')->where('name', 'Outdoor')->first()->id;

        // Non-custom products (10 items)
        $nonCustomProducts = [
            [
                'name' => 'Poster A4',
                'desc' => 'Poster ukuran A4 dengan kualitas cetak tinggi',
                'image' => 'poster.jpg',
                'sizes' => json_encode(['A4 (21x29.7 cm)', 'A3 (29.7x42 cm)']),
                'prices' => json_encode([50000, 75000]),
                'is_featured' => true,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Brosur Lipat',
                'desc' => 'Brosur lipat tiga dengan desain profesional',
                'image' => 'brochure.jpg',
                'sizes' => json_encode(['A4 Lipat 3', 'A5 Lipat 2']),
                'prices' => json_encode([45000, 35000]),
                'is_featured' => false,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Kartu Nama',
                'desc' => 'Kartu nama premium dengan berbagai finishing',
                'image' => 'business-card.jpg',
                'sizes' => json_encode(['9x5 cm', '8.5x5.5 cm']),
                'prices' => json_encode([30000, 35000]),
                'is_featured' => true,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Flyer Promo',
                'desc' => 'Flyer promosi dengan desain menarik',
                'image' => 'flyer.jpg',
                'sizes' => json_encode(['A5 (14.8x21 cm)', 'A6 (10.5x14.8 cm)']),
                'prices' => json_encode([25000, 20000]),
                'is_featured' => false,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Sticker Vinyl',
                'desc' => 'Sticker vinyl tahan air dan UV',
                'image' => 'sticker.jpg',
                'sizes' => json_encode(['10x10 cm', '15x15 cm', '20x20 cm']),
                'prices' => json_encode([15000, 30000, 50000]),
                'is_featured' => true,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Banner Vinyl',
                'desc' => 'Banner vinyl outdoor tahan cuaca',
                'image' => 'banner.jpg',
                'sizes' => json_encode(['60x160 cm', '80x200 cm', '100x300 cm']),
                'prices' => json_encode([150000, 250000, 400000]),
                'is_featured' => false,
                'is_custom' => false,
                'category_id' => $outdoorCategory
            ],
            [
                'name' => 'Spanduk Promosi',
                'desc' => 'Spanduk promosi dengan bahan berkualitas',
                'image' => 'banner.jpg',
                'sizes' => json_encode(['50x150 cm', '70x200 cm']),
                'prices' => json_encode([120000, 180000]),
                'is_featured' => true,
                'is_custom' => false,
                'category_id' => $outdoorCategory
            ],
            [
                'name' => 'Backdrop Stand',
                'desc' => 'Backdrop untuk event dengan stand portable',
                'image' => 'backdrop.jpg',
                'sizes' => json_encode(['2x3 m', '3x4 m', '4x6 m']),
                'prices' => json_encode([500000, 750000, 1200000]),
                'is_featured' => false,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'X-Banner',
                'desc' => 'X-Banner portable dengan stand kokoh',
                'image' => 'standee.jpg',
                'sizes' => json_encode(['60x160 cm', '80x200 cm']),
                'prices' => json_encode([200000, 300000]),
                'is_featured' => true,
                'is_custom' => false,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Billboard',
                'desc' => 'Billboard ukuran besar untuk promosi outdoor',
                'image' => 'billboard.jpg',
                'sizes' => json_encode(['3x6 m', '4x8 m', '5x10 m']),
                'prices' => json_encode([2500000, 4000000, 6000000]),
                'is_featured' => false,
                'is_custom' => false,
                'category_id' => $outdoorCategory
            ]
        ];

        // Custom products (10 items)
        $customProducts = [
            [
                'name' => 'Kemasan Custom',
                'desc' => 'Desain kemasan produk sesuai kebutuhan Anda',
                'image' => 'packaging.jpg',
                'is_featured' => true,
                'is_custom' => true,
                'price_per_size' => 100000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Undangan Pernikahan',
                'desc' => 'Undangan pernikahan dengan desain eksklusif',
                'image' => 'wedding-invitation.jpg',
                'is_featured' => false,
                'is_custom' => true,
                'price_per_size' => 75000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Label Produk',
                'desc' => 'Label custom untuk produk Anda',
                'image' => 'product-label.jpg',
                'is_featured' => true,
                'is_custom' => true,
                'price_per_size' => 50000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Baju Seragam',
                'desc' => 'Sablon baju seragam perusahaan',
                'image' => 'uniform.jpg',
                'is_featured' => false,
                'is_custom' => true,
                'price_per_size' => 120000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Kartu Ucapan',
                'desc' => 'Kartu ucapan dengan desain khusus',
                'image' => 'greeting-card.jpg',
                'is_featured' => true,
                'is_custom' => true,
                'price_per_size' => 45000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Neon Box',
                'desc' => 'Neon box custom untuk toko atau usaha',
                'image' => 'neon-box.jpg',
                'is_featured' => false,
                'is_custom' => true,
                'price_per_size' => 2500000,
                'category_id' => $outdoorCategory
            ],
            [
                'name' => 'Sticker Mobil',
                'desc' => 'Sticker custom untuk kendaraan',
                'image' => 'car-sticker.jpg',
                'is_featured' => true,
                'is_custom' => true,
                'price_per_size' => 300000,
                'category_id' => $outdoorCategory
            ],
            [
                'name' => 'Booth Exhibition',
                'desc' => 'Booth pameran dengan desain khusus',
                'image' => 'exhibition-booth.jpg',
                'is_featured' => false,
                'is_custom' => true,
                'price_per_size' => 5000000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Wall Decal',
                'desc' => 'Wall decal untuk dekorasi interior',
                'image' => 'wall-decal.jpg',
                'is_featured' => true,
                'is_custom' => true,
                'price_per_size' => 200000,
                'category_id' => $indoorCategory
            ],
            [
                'name' => 'Signage Toko',
                'desc' => 'Signage custom untuk toko atau kantor',
                'image' => 'store-signage.jpg',
                'is_featured' => false,
                'is_custom' => true,
                'price_per_size' => 1500000,
                'category_id' => $outdoorCategory
            ]
        ];

        // Insert products
        DB::table('products')->insert($nonCustomProducts);
        DB::table('products')->insert($customProducts);
    }
}
