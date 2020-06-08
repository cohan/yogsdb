<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('members', 'MemberController')->only(['index', 'show']);
Route::resource('channels', 'ChannelController')->only(['index', 'show']);
Route::resource('videos', 'VideoController')->only(['index', 'show']);