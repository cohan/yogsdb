<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', function() {
	return view('home');
});

Route::get('/', "HomeController@welcome");

Route::get('/search', "SearchController@search");

//Route::resource('series', 'SeriesController');

Route::resource('video', 'VideoController', [ 'only' => ['edit', 'update'] ]);

Route::get('/tag/{tag}', function() { return "tbc"; } );

Route::get('/{channel}', "ChannelController@show");

Route::get('/{channel}/{video}', "VideoController@show");

