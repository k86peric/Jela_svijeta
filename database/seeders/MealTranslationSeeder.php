<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meals = [1, 2, 3];

        $languages = [1, 2];

        foreach ($meals as $mealId) {
            foreach ($languages as $languageId) {
                $title = ($languageId === 1) ? "Meal Title in English" : "Naziv jela na Hrvatskom";
                $description = ($languageId === 1) ? "Meal Description in English" : "Opis jela na Hrvatskom";

                DB::table('meal_translations')->insert([
                    'meal_id' => $mealId,
                    'locale' => ($languageId === 1) ? 'en' : 'hr',
                    'title' => $title,
                    'description' => $description,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
