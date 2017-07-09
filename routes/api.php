<?php

use Illuminate\Http\Request;
use App\Star;

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
	$domain = "api.yogsdb.dev";
}


Route::domain($domain)->middleware(['middleware' => 'cors'])->group(function () {
	Route::get('/', function() {
		return redirect("https://docs.yogsdb.com/api");
	});

	Route::get('stars', function() {
		return Star::paginate();
	});
});
