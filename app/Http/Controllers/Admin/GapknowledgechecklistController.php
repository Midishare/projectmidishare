<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGapKnowledgeChecklist;
use Illuminate\Http\Request;


class GapknowledgechecklistController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('gapknowledge')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
        foreach ($users as $user) {
            if (!$user->gapknowledge) {
                $user->gapknowledge()->create([
                    'OHK' => false,
                    'BPA' => false,
                    'MOM' => false,
                    'INT' => false,
                    'INO' => false,
                    'KST' => false,
                    'OPP' => false,
                    'KPT' => false,
                    'PBB' => false,
                    'PDP' => false,
                    'MDM' => false,
                    'MKP' => false,
                    'KPP' => false,
                    'APM' => false,
                    'KEF' => false,
                    'PNG' => false,
                    'MHK' => false,
                    'KPD' => false,
                ]);
            }
        }

        return view('admin.gapknow', compact('users'));
    }

    public function update(Request $request, $userId)
    {
        $checklist = UserGapKnowledgeChecklist::firstOrCreate(['user_id' => $userId]);

        // Update modul checklist berdasarkan request dari admin
        $checklist->update([
            'OHK' => $request->has('OHK'),
            'BPA' => $request->has('BPA'),
            'MOM' => $request->has('MOM'),
            'INT' => $request->has('INT'),
            'INO' => $request->has('INO'),
            'KST' => $request->has('KST'),
            'OPP' => $request->has('OPP'),
            'KPT' => $request->has('KPT'),
            'PBB' => $request->has('PBB'),
            'PDP' => $request->has('PDP'),
            'MDM' => $request->has('MDM'),
            'MKP' => $request->has('MKP'),
            'KPP' => $request->has('KPP'),
            'APM' => $request->has('APM'),
            'KEF' => $request->has('KEF'),
            'PNG' => $request->has('PNG'),
            'MHK' => $request->has('MHK'),
            'KPD' => $request->has('KPD'),
        ]);

        return redirect()->back()->with('success', 'Checklist updated successfully.');
    }
}
