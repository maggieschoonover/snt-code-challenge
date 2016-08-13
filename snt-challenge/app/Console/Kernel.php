<?php

namespace App\Console;

use DB;
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
        Commands\Inspire::class,
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

            ini_set('auto_detect_line_endings', true);
            $line = fgets(fopen($filename, 'r'));

            $eol = "\r\n";

            if(strpos($line, "\r\n") !== false) {
                $eol = "\r\n";
            }
            else if (strpos($line, "\r") !== false) {
                $eol = "\r";
            }
            else if (strpos($line, "\n") !== false) {
                $eol = "\n";
            }

            $query = "LOAD DATA LOCAL INFILE '".$filename."' INTO TABLE home_wx_facts
                FIELDS TERMINATED BY '|'
                ENCLOSED BY '\"'
                LINES TERMINATED BY '".$eol."'
                IGNORE 1 LINES
                (WeatherDetailsId,WeatherDetailsCity,WeatherDetailsState,WeatherDetailsCounty,WeatherDetailsStateFIPS,WeatherDetailsCountyFIPS,WeatherDetailsStationID,WeatherDetailsMaxTempFahrenheit,WeatherDetailsMinTempFahrenheit,WeatherDetailsAvgTempFahrenheit,WeatherDetailsDewPointFahrenheit,WeatherDetailsPressureIn,WeatherDetailsPrecipitationInch,WeatherDetailsSnowfallInch,WeatherDetailsThunderstormsDays,WeatherDetailsHeavyFogMiles,WeatherDetailsWindSpeedMph,WeatherDetailsHeatingDegreeDays,WeatherDetailsColdDegreeDays,WeatherDetailsYear,WeatherDetailsMonth,timestamp)
                SET timestamp = CURRENT_TIMESTAMP;";

            DB::unprepared($query);

        // })->everyMinute();
        })->dailyAt('02:00')->timezone('America/New_York');
    }
}
