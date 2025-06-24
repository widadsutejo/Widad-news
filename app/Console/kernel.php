<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\FetchNewsFromApi; // Import command kamu di sini

class Kernel extends ConsoleKernel
{
    /**
     * Daftar command Artisan yang disediakan oleh aplikasi.
     */
    protected $commands = [
        FetchNewsFromApi::class, // Daftarkan command-nya di sini
    ];

    /**
     * Tentukan jadwal tugas Artisan.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Jalankan setiap jam
        $schedule->command('app:fetch-news-from-api')->hourly();
    }

    /**
     * Daftarkan perintah Artisan untuk aplikasi.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
