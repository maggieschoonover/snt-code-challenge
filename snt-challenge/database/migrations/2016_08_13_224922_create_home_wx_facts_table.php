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