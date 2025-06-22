<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\Author;
use App\Models\NewsCategory;

class FetchNewsFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news-from-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news from newsdata.io API and store it in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching news from Newsdata.io...');

        $apiKey = config('services.newsdata.key');

        if (!$apiKey) {
            $this->error('Newsdata.io API key is not set. Please check your .env file.');
            return 1;
        }

        $response = Http::get('https://newsdata.io/api/1/news', [
            'apikey' => $apiKey,
            'country' => 'id',
            'language' => 'id',
        ]);

        if ($response->failed()) {
            $this->error('Failed to fetch news from the API.');
            $this->error('Response: ' . $response->body());
            return 1;
        }

        $articles = $response->json()['results'] ?? [];

        if (empty($articles)) {
            $this->info('No new articles found.');
            return 0;
        }

        $this->info(count($articles) . ' articles found. Starting to process...');

        foreach ($articles as $article) {
            if (News::where('title', $article['title'])->exists()) {
                $this->warn("Article '{$article['title']}' already exists. Skipping.");
                continue;
            }

            $authorName = is_array($article['creator']) ? implode(', ', $article['creator']) : ($article['creator'] ?? 'Unknown Author');
            
            $author = Author::firstOrCreate(
                ['name' => $authorName],
                [
                    'username' => Str::slug($authorName),
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($authorName) . '&background=random',
                    'email' => strtolower(Str::slug($authorName)) . '@example.com',
                    'bio' => 'Author from Newsdata.io'
                ]
            );

            $categoryName = is_array($article['category']) ? $article['category'][0] : ($article['category'] ?? 'Uncategorized');
            
            // Cari atau buat Kategori Berita menggunakan kolom 'title'
            $category = NewsCategory::firstOrCreate(
                ['title' => Str::title($categoryName)], // <-- PERUBAHAN TERAKHIR DI SINI
                ['slug' => Str::slug($categoryName)]
            );
            
            News::create([
                'title' => $article['title'],
                'slug' => Str::slug($article['title']),
                'thumbnail' => $article['image_url'],
                'content' => $article['content'] ?? $article['description'] ?? 'No content available.',
                'author_id' => $author->id,
                'news_category_id' => $category->id,
                'is_featured' => false,
            ]);

            $this->info("Successfully stored article: '{$article['title']}'");
        }

        $this->info('Finished fetching and storing news.');
        return 0;
    }
}