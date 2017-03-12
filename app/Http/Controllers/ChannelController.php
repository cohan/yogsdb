<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Video;
use Illuminate\Http\Request;

class ChannelController extends Controller
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
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function show($channel)
	{
		//
		try {
			$channel = Channel::where(['slug' => $channel])->with('videos')->firstOrFail();
		}
		catch (Exception $e) {
			return;
		}

		$videos = $channel->videos()->paginate(12);

		return view('ydb.channel')->with('channel', $channel)->with('videos', $videos);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Channel $channel)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Channel $channel)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Channel  $channel
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Channel $channel)
	{
		//
	}
}
