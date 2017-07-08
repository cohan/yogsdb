<?php

namespace App\Http\Controllers;

use App\Video;
use App\Star;

use Auth;

use Illuminate\Http\Request;

class VideoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Video  $video
	 * @return \Illuminate\Http\Response
	 */
	public function show($channel, $video)
	{
		//
		$video = Video::where(['slug' => $video])
		->with('stars')
		->withCount('stars')
		->with('series')
		->with('game')
		->with('channel')
		->first();

		if (empty($video)) { abort(404); }

		return view('ydb.video')->with('video', $video)->with('pageType', 'video');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Video  $video
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Video $video)
	{
		//
		if (!Auth::check() || !Auth::user()->hasAnyRole('admin', 'moderator')) {
			return redirect()->guest('login');
		}

		return view('ydb.editvideo')->with('video', $video);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Video  $video
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Video $video)
	{
		//
		if (Auth::check()) {
			$user = Auth::user();
		}
		else {
			die('wat');
		}

		if (!$user->hasAnyRole(['admin', 'moderator'])) {
			die('wat');
		}

		$video->stars()->sync($request->get('starring'));

		// $video->series()->sync($request->get('series'));

		$video->game_id = $request->get('game');

		$video->save();

		return redirect("/".$video->channel->slug."/".$video->slug);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Video  $video
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Video $video)
	{
		//
	}
}
