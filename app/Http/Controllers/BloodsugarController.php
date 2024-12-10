<?php

namespace App\Http\Controllers;

use App\Models\Bloodsugar;
use App\Services\BloodSugarExpertSystem;
use Illuminate\Http\Request;

class BloodsugarController extends Controller
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

        $bloodSugar = Bloodsugar::create([
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

    public function create(Bloodsugar $bloodSugar)
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        $bloodSugars = Bloodsugar::where('user_id', auth()->id())
            ->latest('checked_at')
            ->paginate(10);

        $bloodSugar = $this->expertSystem->assessOverallStatus($bloodSugars);

        return view('admin.bloodsugar.check', compact('layout', 'bloodSugars', 'bloodSugar'));
    }

    public function standarisasiobatmidi()
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        return view('standarisasiobatalfamidi', compact('layout'));
    }
}
