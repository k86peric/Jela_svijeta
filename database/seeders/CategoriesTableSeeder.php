<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use FakerRestaurant\Restaurant;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakerEn = Faker::create('en_US');
        $fakerHr = Faker::create('hr_HR');

        for ($i = 0; $i < 7; $i++) {
            $slug = 'category-' . $i;

            $category_id = DB::table('categories')->insertGetId([
                'slug' => $slug,
            ]);

            DB::table('category_translations')->insert([
                [
                    'locale' => 'en_US',
                    'title' => $fakerEn->word,
                    'category_id' => $category_id,
                ],
                [
                    'locale' => 'hr_HR',
                    'title' => $fakerHr->word,
                    'category_id' => $category_id,
                ],
            ]);
        }
    }
}