<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

class SearchController extends Controller
{
    //

	public function search (Request $request) {
		$videos = Video::search($request->q)->orderBy('upload_date', 'desc')->paginate(12);

		return view('ydb.welcome')->with('videos', $videos);
	}
}
