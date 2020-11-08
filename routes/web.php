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
    $domain = "";
}

if (config('app.env') == 'production') {
	$apiDomain = "api.yogsdb.com";
}
else {
	$apiDomain = "api.yogsdb.test";
}

Route::domain($domain)->group(function () {

	// Just for the frontend, redirect to something useful
	// API still works. Frontend was just broken and useless

	Route::fallback( function() {
		return redirect('https://schedule.yogs.app/#/all');
    });

});

Route::domain($apiDomain)->group(function () {
	Route::get('/', function() {
		return redirect("https://docs.yogsdb.com/api");
	});	
});
