<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'VideoController@index');

Route::get('tos', 'HomeController@tos');
Route::get('privacy', 'HomeController@privacy');
Route::get('about', 'HomeController@about');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('members', 'MemberController')->only(['index', 'show']);
Route::resource('channels', 'ChannelController')->only(['index', 'show']);
Route::resource('videos', 'VideoController')->only(['index', 'show']);
