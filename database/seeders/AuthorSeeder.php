<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'name' => 'Mamat Sutejo',
                'username' => 'mamats',
                'avatar' => 'default-avatar.jpg',
                'bio' => 'Developer passionate about tech and news media.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin Portal',
                'username' => 'adminportal',
                'avatar' => 'admin-avatar.jpg',
                'bio' => 'Administrator for the news portal.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
