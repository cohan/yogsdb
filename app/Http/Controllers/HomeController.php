<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function tos()
    {
        return view('tos');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function about()
    {
        return view('about');
    }

}
