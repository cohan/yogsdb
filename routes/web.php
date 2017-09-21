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

if (config('app.env') == 'production') {
	$domain = "yogsdb.com";
}
else {
	$domain = "yogsdb.test";
}

if (config('app.env') == 'production') {
	$apiDomain = "api.yogsdb.com";
}
else {
	$apiDomain = "api.yogsdb.test";
}


Route::domain($domain)->group(function () {

	Auth::routes();

	Route::get('/home', function() {
		return view('home');
	});

	Route::get('/', "HomeController@welcome");

	Route::get('/search', "SearchController@search");

	Route::get('/onthisday', "VideoController@onThisDay");

	//Route::resource('series', 'SeriesController');

	Route::resource('video', 'VideoController', [ 'only' => ['edit', 'update'] ]);

	Route::resource('star', 'StarController', [ 'only' => ['edit', 'update'] ]);

	Route::get('/game/{game}', "GameController@show");

	Route::get('/star/{star}', "StarController@show");

	Route::get('/tag/{tag}', function() { return "tbc"; } );

	Route::get('/{channel}', "ChannelController@show");

	Route::get('/{channel}/{video}', "VideoController@show");

});

Route::domain($apiDomain)->group(function () {
	Route::get('/', function() {
		return redirect("https://docs.yogsdb.com/api");
	});	
});
