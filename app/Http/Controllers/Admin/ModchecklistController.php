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
        // Ambil query pencarian dari request
        $search = $request->input('search');

        // Dapatkan pengguna dengan modChecklists, dengan pencarian dan paginasi
        $users = User::with('modChecklists')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10); // Batasi 10 pengguna per halaman

        // Buat data checklist jika belum ada
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

        // Update modul checklist berdasarkan request dari admin
        $checklist->update([
            'existing_grade_genap' => $request->has('existing_grade_genap'),
            'ip' => $request->has('ip'),
            'existing_grade_ganjil' => $request->has('existing_grade_ganjil'),
            'mdp' => $request->has('mdp'),
        ]);

        return redirect()->back()->with('success', 'Checklist updated successfully.');
    }
}
