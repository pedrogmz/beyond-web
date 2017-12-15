<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Download extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.download');
    }
}
