<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LanguagesSeeder::class,
            CategoriesSeeder::class,
            CategoryTranslationsSeeder::class,
            IngredientsSeeder::class,
            IngredientTranslationsSeeder::class,
            TagsSeeder::class,
            TagTranslationsSeeder::class,
            MealsSeeder::class,
            
        ]);
    }
}
