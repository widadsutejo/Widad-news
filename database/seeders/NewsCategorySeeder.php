<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news_categories')->insert([
            [
                'title' => 'Teknologi',
                'slug' => 'teknologi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Olahraga',
                'slug' => 'olahraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gaya Hidup',
                'slug' => 'gaya-hidup',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
