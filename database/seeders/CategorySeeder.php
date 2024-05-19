<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(10)->create();

        //create category
        // DB::table('categories')->insert([
        //     'name' => 'Wisata Keluarga',
        //     'description' => 'Ticket untuk wisata rombongan keluarga'
        // ]);
    }
}
