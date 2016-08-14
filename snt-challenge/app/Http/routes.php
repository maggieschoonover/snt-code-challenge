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

Route::get('/wx-facts/all',[
	'uses' => 'WxFactsController@showAll'
]);

Route::get('/wx-facts/filter?page={page}&filter={filter}&direction={dir}',[
	'uses' => 'WxFactsController@showFiltered'
]);

Route::resource('wx-facts', 'WxFactsController');

