<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $rekomendasi = collect($user->rekomendasiBelajar);
        $history = collect($user->history);

        return view('profile', compact('user', 'rekomendasi'));
    }
}
