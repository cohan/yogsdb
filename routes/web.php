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

use App\Video;
use Illuminate\Http\Request;

Route::get('/', function () {
	
	$videos = Video::has('channel')->orderBy('upload_date', 'desc')->paginate(12);

    return view('ydb.welcome')->with('videos', $videos);
});


Route::get('/search', function (Request $request) {
    return App\Order::search($request->search)->get();
});

Route::get('/search', function (Request $request) {

	$videos = Video::search($request->q)->orderBy('upload_date', 'desc')->paginate(12);

    return view('ydb.welcome')->with('videos', $videos);
});

