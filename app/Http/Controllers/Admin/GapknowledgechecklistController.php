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
        ]);

        return redirect()->back()->with('success', 'Checklist updated successfully.');
    }
}
