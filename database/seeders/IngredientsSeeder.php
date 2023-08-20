<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            ['slug' => 'ingredient-1'],
            ['slug' => 'ingredient-2'],
            ['slug' => 'ingredient-3'],
        ]);
    }
}
