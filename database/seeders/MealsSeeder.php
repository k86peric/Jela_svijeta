<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [1, 2];

        for ($i = 1; $i <= 15; $i++) {
            foreach ($languages as $languageId) {
                $title = ($languageId === 1) ? "Meal Title {$i} in English" : "Naziv jela {$i} na hrvatskom";
                $description = ($languageId === 1) ? "Meal Description {$i} in English" : "Opis jela {$i} na hrvatskom";

                DB::table('meals')->insert([
                    'category_id' => rand(1, 3),
                    'status' => 'created',

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $mealId = ($i - 1) * count($languages) + $languageId;

                DB::table('meal_translations')->insert([
                    'meal_id' => $mealId,
                    'locale' => ($languageId === 1) ? 'en' : 'hr',
                    'title' => $title,
                    'description' => $description,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('meal_ingredients')->insert([
                    'meal_id' => $mealId,
                    'ingredient_id' => 1,
                ]);

                DB::table('meal_tag')->insert([
                    'meal_id' => $mealId,
                    'tag_id' => rand(1, 3),
                ]);
            }           
        }
    }
}
