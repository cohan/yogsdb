<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

class SearchController extends Controller
{
    //

	public function search (Request $request) {
		if (empty($request->q)) {
			return redirect('/');
		}

		$videos = Video::search($request->q)->paginate(12);

		return view('ydb.welcome')->with('videos', $videos);
	}
}
