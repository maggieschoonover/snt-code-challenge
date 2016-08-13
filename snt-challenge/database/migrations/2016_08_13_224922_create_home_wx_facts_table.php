<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeWxFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_wx_facts', function (Blueprint $table) {
            // $table->increments('id')->unsigned();
            $table->integer('WeatherDetailsId')->unsigned()->unique();
            $table->string('WeatherDetailsCity')->nullable();
            $table->char('WeatherDetailsState',2)->nullable();
            $table->string('WeatherDetailsCounty')->nullable();
            $table->integer('WeatherDetailsStateFIPS')->unsigned()->nullable();
            $table->integer('WeatherDetailsCountyFIPS')->unsigned()->nullable();
            $table->integer('WeatherDetailsStationID')->unsigned()->nullable();
            $table->float('WeatherDetailsMaxTempFahrenheit')->nullable();
            $table->float('WeatherDetailsMinTempFahrenheit')->nullable();
            $table->float('WeatherDetailsAvgTempFahrenheit')->nullable();
            $table->float('WeatherDetailsDewPointFahrenheit')->nullable();
            $table->float('WeatherDetailsPressureIn')->nullable();
            $table->float('WeatherDetailsPrecipitationInch')->nullable();
            $table->float('WeatherDetailsSnowfallInch')->nullable();
            $table->integer('WeatherDetailsThunderstormsDays')->nullable();
            $table->float('WeatherDetailsHeavyFogMiles')->nullable();
            $table->float('WeatherDetailsWindSpeedMph')->nullable();
            $table->integer('WeatherDetailsHeatingDegreeDays')->nullable();
            $table->integer('WeatherDetailsColdDegreeDays')->nullable();
            $table->char('WeatherDetailsYear',4)->nullable();
            $table->char('WeatherDetailsMonth',2)->nullable();
            $table->timestamp('timestamp')->nullable();
        });

        //Import data from file
        // i had to str_replace the backslash on windows dev system... but works on linux, too
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('home_wx_facts');
    }
}