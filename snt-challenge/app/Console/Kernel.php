<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use App\HomeWeatherFacts;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //IMPORT WX DATA
        $schedule->call(function () {
            $filename = str_replace("\\", "/", storage_path('database/HomeWeatherFacts.txt'));
            \App\HomeWxFacts::loadWxDataInfile($filename);
        // })->everyMinute(); //for testing
        })->dailyAt('02:00')->timezone('America/New_York');
    }
}
