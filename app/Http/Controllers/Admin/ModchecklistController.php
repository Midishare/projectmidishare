<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModChecklist;
use Illuminate\Http\Request;

class ModchecklistController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('modChecklists')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
        foreach ($users as $user) {
            if (!$user->modChecklists) {
                $user->modChecklists()->create([
                    'existing_grade_genap' => false,
                    'ip' => false,
                    'existing_grade_ganjil' => false,
                    'mdp' => false,
                ]);
            }
        }

        return view('admin.checklist', compact('users', 'search'));
    }



    public function update(Request $request, $userId)
    {
        $checklist = UserModChecklist::firstOrCreate(['user_id' => $userId]);
        $checklist->update([
            'existing_grade_genap' => $request->has('existing_grade_genap'),
            'ip' => $request->has('ip'),
            'existing_grade_ganjil' => $request->has('existing_grade_ganjil'),
            'mdp' => $request->has('mdp'),
        ]);

        return redirect()->back()->with('success', 'Checklist updated successfully.');
    }
}
