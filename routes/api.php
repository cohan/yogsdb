<?php

use Illuminate\Http\Request;
use App\Filters\VideoFilters;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if (config('app.env') == 'production') {
	$domain = "api.yogsdb.com";
}
else {
	$domain = "api.yogsdb.test";
}


Route::domain($domain)->middleware(['middleware' => 'cors'])->group(function () {
	Route::get('/', function() {
		return redirect("https://docs.yogsdb.com/api");
	});	


	Route::get('channels', function() {
		return App\Channel::paginate(25);
	});
	Route::get('channels/{id}', function($id) {
		return App\Channel::find($id);
	});


	Route::get('videos', function(VideoFilters $filters, Request $request) {

		if ($request->has('limit') && $request->input <= 1000) {
			$limit = $request->input('limit');
		}
		else {
			$limit = 25;
		}

		return App\Video::filter($filters)
			->with('channel')
			->with('game')
			->with('stars')
			->paginate($limit)
			->appends($request->except(['page']));

		// return App\Video::orderBy('upload_date', 'desc')
		// 	->with('channel')
		// 	->with('game')
		// 	->with('stars')->paginate(25);
	});
	Route::get('videos/{id}', function($id) {
		return App\Video::with('channel')
			->with('game')
			->with('stars')
			->find($id);
	});


	Route::get('stars', function() {
		return App\Star::with('channel')
			->paginate(1);
	});
	Route::get('stars/{id}', function($id) {
		return App\Star::with('channel')
			->find($id);
	});


	Route::get('games', function() {
		return App\Game::paginate(25);
	});
	Route::get('games/{id}', function($id) {
		return App\Game::find($id);
	});
});
