<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'author_id' => 1, // pastikan id author 1 sudah ada
                'news_category_id' => 1, // pastikan kategori 1 sudah ada
                'title' => 'Berita Pertama',
                'slug' => 'berita-pertama',
                'thumbnail' => 'berita1.jpg',
                'content' => 'Ini adalah isi dari berita pertama.',
                'is_featured' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'author_id' => 2,
                'news_category_id' => 2,
                'title' => 'Berita Kedua',
                'slug' => 'berita-kedua',
                'thumbnail' => 'berita2.jpg',
                'content' => 'Ini adalah isi dari berita kedua.',
                'is_featured' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
