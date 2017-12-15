<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Itemshop extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.paypal');
    }
}
