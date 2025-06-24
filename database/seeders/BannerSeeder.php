<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'news_id' => 1, // pastikan ID ini cocok dengan data di tabel 'news'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'news_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
