// app/Console/Kernel.php

protected function schedule(Schedule $schedule): void
{
    // $schedule->command('inspire')->hourly();

    // Jalankan command pengambilan berita setiap jam
    $schedule->command('app:fetch-news-from-api')->hourly(); 
}