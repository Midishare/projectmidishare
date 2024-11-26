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

    public function create()
    {

        return view('admin.bloodsugar.check');
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

    public function show(BloodSugar $bloodSugar)
    {
        return view('admin.bloodsugar.analysis', compact('bloodSugar'));
    }

    public function historyblood()
    {
        $bloodSugars = BloodSugar::where('user_id', auth()->id())
            ->latest('checked_at')
            ->paginate(10);

        return view('admin.bloodsugar.history', compact('bloodSugars'));
    }
}
