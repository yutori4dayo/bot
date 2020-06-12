<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SampleCommand::class,
        Commands\prejectCommand::class,
        Commands\GetTrends::class,
        Commands\GetFriend::class,
        Commands\GetScraping::class,
        Commands\PostScraping::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       // $schedule->command('command:name')->everyThirtyMinutes();
       // $schedule->command('command:favorites')->twiceDaily(12, 21);
       $schedule->command('get:friend')->dailyAt('19:00');
       $schedule->command('get:aa')->twiceDaily(15,21);
       $schedule->command('post:Scraping')->between('7:00','23:00')->hourlyAt(17);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
