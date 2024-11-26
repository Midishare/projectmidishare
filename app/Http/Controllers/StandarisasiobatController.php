<?php

namespace App\Http\Controllers;

use App\Models\BloodSugar;


class StandarisasiobatController extends Controller
{
    public function content()
    {
        return view('healthcarecontent');
    }

    public function bloodsugarcontent()
    {
        $latestBloodSugar = BloodSugar::where('user_id', auth()->id())->latest('checked_at')->first();

        return view('Bloodsugar', compact('latestBloodSugar'));
    }
}
