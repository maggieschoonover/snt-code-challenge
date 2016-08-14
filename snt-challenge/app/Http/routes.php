<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//return all values from home_wx_facts table as JSON
Route::get('/wx-facts/all',[
	'uses' => 'WxFactsController@showAll'
]);

/*
* return filtered values from home_wx_facts table and paginate
* Restful method 1: defined parameters
* e.g. /wx-facts/filter/50/WeatherDetailsYear/asc
*/
Route::get('/wx-facts/filter/{page?}/{column?}/{direction?}',[
	'uses' => 'WxFactsController@showFiltered'
]);

/*
* update city, state for row in home_wx_facts table 
* Restful method 2: Request dynamic parameters
* e.g. /wx-facts/updateCityState?id=1234&city=Somewhere&state=IA
*/
Route::get('/wx-facts/updateCityState',[
	'uses' => 'WxFactsController@updateCityState'
]);

Route::resource('wx-facts', 'WxFactsController');

