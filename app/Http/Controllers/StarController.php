<?php

namespace App\Http\Controllers;

use App\Star;
use App\AutoStars;
use Illuminate\Http\Request;

use Auth;

class StarController extends Controller
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
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function show(Star $star)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function edit(Star $star)
    {
        //
        if (!Auth::check() || !Auth::user()->hasAnyRole('admin', 'moderator')) {
            return redirect()->guest('login');
        }

        $title = "Editing ".$star->title;

        return view('ydb.editstar')->with('star', $star)->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Star $star)
    {
        //
        foreach ($request->input('pattern') as $id => $patternUpdate) {
            $pattern = AutoStars::find($id);

            // Make sure we're editing the current star..
            if ($pattern->star_id != $star->id) { continue; }

            if (!empty($patternUpdate['delete'])) {
                $pattern->delete();
                continue;
            }

            $pattern->pattern = $patternUpdate['pattern'];
            $pattern->weight = $patternUpdate['weight'];
            $pattern->title_modifier = $patternUpdate['title_modifier'];

            $pattern->save();
        }

        if ($request->has('newpattern')) {
            foreach ($request->input('newpattern') as $newPattern) {
                if (empty($newPattern['pattern'])) { continue; }

                $pattern = new AutoStars();

                $pattern->star_id = $star->id;
                $pattern->pattern = $newPattern['pattern'];
                $pattern->weight = $newPattern['weight'];
                $pattern->title_modifier = $newPattern['title_modifier'];

                $pattern->save();
            }
        }

        return redirect('/star/'.$star->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Star  $star
     * @return \Illuminate\Http\Response
     */
    public function destroy(Star $star)
    {
        //
    }
}
