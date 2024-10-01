<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivestreamController extends Controller
{
    public function index()
    {
        return view('livestream');
    }
};
