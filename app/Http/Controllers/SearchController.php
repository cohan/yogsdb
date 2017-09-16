<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

class SearchController extends Controller
{
    //

	public function search (Request $request) {
		if (!$request->has('query')) {
			return redirect('/');
		}

		$videos = Video::search($request->input('query'))->paginate(24);

		return view('ydb.welcome')->with('videos', $videos);
	}
}
