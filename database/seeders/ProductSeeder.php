<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // \App\Models\Product::truncate();

        for ($i=0; $i < 10; $i++) {

            $sizes = ['3x3', '4x4', '5x5', '6x6', '7x7', '8x8', '9x9', '10x10'];
            $prices = [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000];

            \App\Models\Product::create([
                'name' => $faker->word,
                'desc' => $faker->text,
                'image' => $faker->imageUrl(640, 480, 'animals', true),
                'sizes' => json_encode($sizes),
                'prices' => json_encode($prices),
            ]);
        }
    }
}
