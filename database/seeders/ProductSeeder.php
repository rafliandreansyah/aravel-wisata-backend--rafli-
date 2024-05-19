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
        DB::table('products')->insert([
            'name' => 'Tiket wisata',
            ''
        ]);
    }
}
