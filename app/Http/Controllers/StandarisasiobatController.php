<?php

namespace App\Http\Controllers;

use App\Models\Bloodsugar;


class StandarisasiobatController extends Controller
{
    public function content()
    {
        return view('healthcarecontent');
    }

    public function bloodsugarcontent()
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        $latestBloodSugar = Bloodsugar::where('user_id', auth()->id())->latest('checked_at')->first();

        return view('Bloodsugar', compact('latestBloodSugar', 'layout'));
    }
}
