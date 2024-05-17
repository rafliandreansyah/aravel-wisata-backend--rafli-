<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(100)->create();

        //create user role admin
        DB::table('users')->insert([
            'name' => 'Rafli Andreansyah',
            'email' => 'rafli@gmail.com',
            'phone' => '081232720821',
            'password' => Hash::make('amaterasu'),
            'role' => 'admin'
        ]);
    }
}
