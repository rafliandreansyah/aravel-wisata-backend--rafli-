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
        //Category::factory(10)->create();

        //create category
        DB::table('categories')->insert([
            'name' => 'Wisata Coban Talun',
            'description' => 'Category wisata Coban Talun'
        ]);
        DB::table('categories')->insert([
            'name' => 'Wisata Coban Rondo',
            'description' => 'Category wisata Coban Rondo'
        ]);
        DB::table('categories')->insert([
            'name' => 'Wisata Coban Selecta',
            'description' => 'Category wisata Selecta'
        ]);
    }
}
