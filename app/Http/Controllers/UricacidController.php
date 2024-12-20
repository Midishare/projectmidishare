<?php

namespace App\Http\Controllers;

use App\Models\Uricacid;
use App\Services\UricAcidExpertSystem;
use Illuminate\Http\Request;

class UricacidController extends Controller
{
    private $expertSystem;

    public function __construct(UricAcidExpertSystem $expertSystem)
    {
        $this->expertSystem = $expertSystem;
    }

    public function store(Request $request)
    {
        $request->validate([
            'uric_acid_level' => 'required|numeric|min:0',
            'gender' => 'required|in:male,female',
        ]);

        $result = $this->expertSystem->analyze(
            $request->uric_acid_level,
            $request->gender
        );

        $uricAcid = UricAcid::create([
            'user_id' => auth()->id(),
            'uric_acid_level' => $request->uric_acid_level,
            'gender' => $request->gender,
            'result_status' => $result['status'],
            'result_level' => $result['level'],
            'result_risk' => $result['risk'],
            'checked_at' => now()
        ]);

        return redirect()->route('uricacid.create', $uricAcid)
            ->with('result', $result);
    }

    public function create(Request $request)
    {
        $userRole = auth()->user()->getRoleNames()->first();
        $layout = ($userRole === 'admin') ? 'layouts.layoutsadmin' : 'layouts.layouts';

        $uricAcidsQuery = UricAcid::where('user_id', auth()->id());
        if ($request->has('start_date') && $request->has('end_date')) {
            $uricAcidsQuery->whereBetween('checked_at', [
                $request->input('start_date'),
                $request->input('end_date'),
            ]);
        }

        $uricAcids = $uricAcidsQuery->latest('checked_at')->paginate(10);

        $latestAnalysis = $uricAcids->isNotEmpty()
            ? $this->expertSystem->assessOverallStatus($uricAcids)
            : (object)[
                'result_status' => 'Belum Ada Data',
                'result_level' => 'Tidak Diketahui',
                'result_risk' => 'Perlu Pemeriksaan',
                'uric_acid_level' => 0,
                'checked_at' => now()
            ];


        return view('uricacids', compact('layout', 'uricAcids', 'latestAnalysis'))
            ->with('message', $latestAnalysis ? null : 'Tidak ada data analisis terbaru.');
    }
}
