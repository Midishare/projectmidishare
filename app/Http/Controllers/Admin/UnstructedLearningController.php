<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserUnstructedLearning;
use Illuminate\Http\Request;

class UnstructedLearningController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('unstructedlearningchecklist')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);
        foreach ($users as $user) {
            if (!$user->unstructedlearningchecklist) {
                $user->unstructedlearningchecklist()->create([
                    'ks' => 0,
                    'bs' => 0,
                    'webinar' => 0,
                    'sme' => 0,
                    'leaderstalk' => 0,
                    'onlinecourse' => 0,
                    'cop' => 0,
                    'podcast' => 0,
                    'jurnal' => 0,
                    'forumdiskusi' => 0,
                ]);
            }
        }

        return view('admin.unslearn', compact('users', 'search'));
    }

    public function update(Request $request, $userId)
    {
        $checklist = UserUnstructedLearning::firstOrCreate(['user_id' => $userId]);
        $checklist->update([
            'ks' => $request->input('ks', 0),
            'bs' => $request->input('bs', 0),
            'webinar' => $request->input('webinar', 0),
            'sme' => $request->input('sme', 0),
            'leaderstalk' => $request->input('leaderstalk', 0),
            'onlinecourse' => $request->input('onlinecourse', 0),
            'cop' => $request->input('cop', 0),
            'podcast' => $request->input('podcast', 0),
            'jurnal' => $request->input('jurnal', 0),
            'forumdiskusi' => $request->input('forumdiskusi', 0),
        ]);

        return redirect()->back()->with('success', 'Checklist updated successfully.');
    }
}
