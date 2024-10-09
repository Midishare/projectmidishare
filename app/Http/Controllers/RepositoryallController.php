<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class RepositoryallController extends Controller
{
    public function materi()
    {
        $user = Auth::user();

        // Check if the user has access
        if ($user->class == 'MOD') {
            return view('materi', ['users' => $user]);
        }

        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        // Continue with the logic to show the view
    }

    public function materiogm()
    {
        $user = Auth::user();

        // Check if the user has access
        if ($user->class == 'SME') {
            return view('materiogm');
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);

        // Continue with the logic to show the view
    }

    public function generallearn()
    {
        $user = Auth::user();

        // Check if the user has access
        if ($user->class == 'FL') {
            return view('generallearn');
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);

        // Continue with the logic to show the view
    }
}
