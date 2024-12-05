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
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';
        $latestBloodSugar = BloodSugar::where('user_id', auth()->id())->latest('checked_at')->first();
        return view('Bloodsugar', compact('latestBloodSugar', 'layout'));
    }
}
