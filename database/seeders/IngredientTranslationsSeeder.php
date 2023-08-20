<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [1, 2, 3];

        $languages = [1, 2];

        foreach ($ingredients as $ingredientId) {
            foreach ($languages as $languageId) {
                $title = ($languageId === 1) ? "Ingredient Title in English" : "Naziv sastojka na hrvatskom";

                DB::table('ingredient_translations')->insert([
                    'ingredient_id' => $ingredientId,
                    'locale' => ($languageId === 1) ? 'en' : 'hr',
                    'title' => $title,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
