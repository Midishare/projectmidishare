<?php

namespace App\Http\Controllers;

use App\Models\BloodSugar;
use App\Services\BloodSugarExpertSystem;
use Illuminate\Http\Request;

class BloodSugarController extends Controller
{
    private $expertSystem;

    public function __construct(BloodSugarExpertSystem $expertSystem)
    {
        $this->expertSystem = $expertSystem;
    }



    public function store(Request $request)
    {
        $request->validate([
            'blood_sugar_level' => 'required|numeric|min:0',
            'condition' => 'required|in:puasa,setelah_makan',
        ]);

        $result = $this->expertSystem->analyze(
            $request->blood_sugar_level,
            $request->condition
        );

        $bloodSugar = BloodSugar::create([
            'user_id' => auth()->id(),
            'blood_sugar_level' => $request->blood_sugar_level,
            'condition' => $request->condition,
            'result_status' => $result['status'],
            'result_level' => $result['level'],
            'result_risk' => $result['risk'],
            'checked_at' => now()
        ]);

        return redirect()->route('blood-sugar.create', $bloodSugar)
            ->with('result', $result);
    }

    public function create(BloodSugar $bloodSugar)
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        $bloodSugars = BloodSugar::where('user_id', auth()->id())
            ->latest('checked_at')
            ->paginate(10);

        // Assess overall status based on all user's blood sugar records
        $bloodSugar = $this->expertSystem->assessOverallStatus($bloodSugars);

        return view('admin.bloodsugar.check', compact('layout', 'bloodSugars', 'bloodSugar'));
    }

    public function standarisasiobatmidi()
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        return view('standarisasiobatalfamidi', compact('layout'));
        // return view('standarisasiobatalfamidi');
    }
}
