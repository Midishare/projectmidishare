<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BukupintarwhController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        return view('users.bukpinwh.index');
    }
}
