<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [1, 2, 3];

        $languages = [1, 2];

        foreach ($tags as $tagId) {
            foreach ($languages as $languageId) {
                $title = ($languageId === 1) ? "Tag Title in English {$tagId}" : "Naziv taga na Hrvatskom {$tagId}";

                DB::table('tag_translations')->insert([
                    'tag_id' => $tagId,
                    'locale' => ($languageId === 1) ? 'en' : 'hr',
                    'title' => $title,
                    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
