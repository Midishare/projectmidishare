<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CholesterolRecord;
use App\Services\CholesterolExpertSystem;

class CholesterolController extends Controller
{
    protected $expertSystem;

    public function __construct(CholesterolExpertSystem $expertSystem)
    {
        $this->expertSystem = $expertSystem;
    }

    public function create()
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'user') ? 'layouts.layouts' : 'layouts.layoutsadmin';

        $cholesterolRecords = CholesterolRecord::where('user_id', auth()->id())
            ->latest('checked_at')
            ->paginate(10);

        return view('CholesterolCheck', compact('layout', 'cholesterolRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_cholesterol' => 'required|numeric|min:0',
            'ldl_cholesterol' => 'nullable|numeric|min:0',
            'hdl_cholesterol' => 'nullable|numeric|min:0',
            'triglycerides' => 'nullable|numeric|min:0'
        ]);

        $data = [
            'total_cholesterol' => $request->total_cholesterol,
            'ldl_cholesterol' => $request->ldl_cholesterol ?? 0,
            'hdl_cholesterol' => $request->hdl_cholesterol ?? 0,
            'triglycerides' => $request->triglycerides ?? 0
        ];

        $result = $this->expertSystem->analyzeComprehensively($data);

        $cholesterolRecord = CholesterolRecord::create([
            'user_id' => auth()->id(),
            'total_cholesterol' => $request->total_cholesterol,
            'ldl_cholesterol' => $request->ldl_cholesterol,
            'hdl_cholesterol' => $request->hdl_cholesterol,
            'triglycerides' => $request->triglycerides,
            'result_status' => $result['status'],
            'result_level' => $result['level'],
            'result_risk' => $result['risk'],
            'checked_at' => now()
        ]);

        return redirect()->route('cholesterol.create')
            ->with('result', $result);
    }
}
