<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [1, 2, 3];

        $languages = [1, 2];

        foreach ($categories as $categoryId) {
            foreach ($languages as $languageId) {
                $title = ($languageId === 1) ? "Category Title in English" : "Naziv Kategorije na Hrvatskom";

                DB::table('category_translations')->insert([
                    'category_id' => $categoryId,
                    'locale' => ($languageId === 1) ? 'en' : 'hr',
                    'title' => $title,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
