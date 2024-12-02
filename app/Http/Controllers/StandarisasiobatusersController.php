<?php

namespace App\Http\Controllers;

use App\Models\BloodSugar;

class StandarisasiobatusersController extends Controller
{
    public function healthcare()
    {
        return view('healthcareusers');
    }

    public function bloodsugarusers()
    {
        $latestBloodSugar = BloodSugar::where('user_id', auth()->id())->latest('checked_at')->first();
        return view('Bloodsugar', compact('latestBloodSugar'));
    }
}
