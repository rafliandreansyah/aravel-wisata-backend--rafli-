<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create product

        for ($i = 0; $i < 100; $i++) {
            DB::table('products')->insert([
                'name' => "Tiket wisata " . ($i + 1),
                'price' => 20000,
                'stock' => 190,
                'image' => '/img/news/img01.jpg',
                'criteria' => 'individual',
                'status' => 'publish',
                'favorite' => false,
                'category_id' => rand(1, 3),
            ]);
        }
    }
}
