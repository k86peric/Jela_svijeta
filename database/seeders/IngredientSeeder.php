<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientTranslation;
use App\Models\Lang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            $ingredient = Ingredient::create([
                'slug' => $faker->unique()->slug,
            ]);

            foreach (Lang::all() as $language) {
                IngredientTranslation::create([
                    'ingredient_id' => $ingredient->id,
                    'locale' => $language->code,
                    'title' => $faker->word,
                ]);
            }
        }
    }
}
