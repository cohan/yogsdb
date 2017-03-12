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
		$video = Video::where(['slug' => $video])->with('stars')->with('series')->with('game')->with('channel')->first();

		return view('ydb.video')->with('video', $video);
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
		$user = Auth::user();

		if (!$user->hasAnyRole(['admin', 'moderator'])) {
			die('wat');
		}

		$video->stars()->sync($request->get('starring'));

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
