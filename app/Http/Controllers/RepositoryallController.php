<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RepositoryallController extends Controller
{
    public function materi()
    {
        try {
            $user = Auth::user();
            return view('materi', ['users' => $user]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'An error occurred while accessing this section.']);
        }
    }

    public function materiogm()
    {
        try {
            $user = Auth::user();
            return view('materiogm');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'An error occurred while accessing this section.']);
        }
    }

    public function generallearn()
    {
        try {
            $user = Auth::user();
            return view('generallearn');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'An error occurred while accessing this section.']);
        }
    }
}
