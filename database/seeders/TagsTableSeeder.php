<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Healthy'],
            ['name' => 'Italian'],
            ['name' => 'Asian'],
            
        ];

        DB::table('tags')->insert($tags);
    }
}
