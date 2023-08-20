<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lang;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [[
            'code' => 'en',
            'name' => 'English'
        ],
        [
            'code' => 'hr',
            'name' => 'Hrvatski'
        ],
    ];

    foreach ($languages as $language){
        Lang::create($language);
    }
    }
}
