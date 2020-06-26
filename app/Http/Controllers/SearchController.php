<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;

class SearchController extends Controller
{
    //

	public function search (Request $request) {
		if (!$request->has('query') || $request->input('query') == '') {
			return redirect('/search?query=pooping+butt');
		}

		$videos = Video::search($request->input('query')." -sjin -caff -caffcast -asmrcast -turps")->paginate(24);

		return view('ydb.welcome')->with('videos', $videos);
	}
}
