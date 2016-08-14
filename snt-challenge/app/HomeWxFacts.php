<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class HomeWxFacts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'home_wx_facts';

    /**
     * The table primary key attributes.
     *
     */
    protected $primaryKey = 'WeatherDetailsId';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['WeatherDetailsId','WeatherDetailsCity','WeatherDetailsState','WeatherDetailsCounty','WeatherDetailsStateFIPS','WeatherDetailsCountyFIPS','WeatherDetailsStationID','WeatherDetailsMaxTempFahrenheit','WeatherDetailsMinTempFahrenheit','WeatherDetailsAvgTempFahrenheit','WeatherDetailsDewPointFahrenheit','WeatherDetailsPressureIn','WeatherDetailsPrecipitationInch','WeatherDetailsSnowfallInch','WeatherDetailsThunderstormsDays','WeatherDetailsHeavyFogMiles','WeatherDetailsWindSpeedMph','WeatherDetailsHeatingDegreeDays','WeatherDetailsColdDegreeDays','WeatherDetailsYear','WeatherDetailsMonth','timestamp'];


    //******* FUNCTIONS *********//

    /*
    * Load data infile from storage
    * parse and add to database
    */
    static function loadWxDataInfile($filename)
    {
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
            (WeatherDetailsId,WeatherDetailsCity,WeatherDetailsState,WeatherDetailsCounty,WeatherDetailsStateFIPS,WeatherDetailsCountyFIPS,WeatherDetailsStationID,WeatherDetailsMaxTempFahrenheit,WeatherDetailsMinTempFahrenheit,WeatherDetailsAvgTempFahrenheit,WeatherDetailsDewPointFahrenheit,WeatherDetailsPressureIn,WeatherDetailsPrecipitationInch,WeatherDetailsSnowfallInch,WeatherDetailsThunderstormsDays,WeatherDetailsHeavyFogMiles,WeatherDetailsWindSpeedMph,WeatherDetailsHeatingDegreeDays,WeatherDetailsColdDegreeDays,WeatherDetailsYear,WeatherDetailsMonth,created_at,updated_at)
            SET created_at = CURRENT_TIMESTAMP,updated_at = CURRENT_TIMESTAMP;";

        DB::unprepared($query);
    }
}
