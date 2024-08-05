<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $statuses = ['pending', 'inprogress', 'completed', 'cancelled'];
        $sizes = ['3x3', '4x4', '5x5', '6x6', '7x7', '8x8', '9x9', '10x10'];
        $prices = [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000];

        for ($i = 0; $i < 10; $i++) {
            \DB::table('orders')->insert([
                'user_id' => 2,
                'product_id' => $faker->numberBetween(1, 10),
                'order_number' => \Str::random(10),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'size' => $faker->randomElement($sizes),
                'price' => $faker->randomElement($prices),
                'qty' => $faker->numberBetween(1, 10),
                'expected_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'notes' => $faker->sentence,
                'path_file' => $faker->filePath(),
                'url_file' => $faker->url,
                'total_amount' => $faker->numberBetween(10000, 100000),
                'status' => $faker->randomElement($statuses),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
