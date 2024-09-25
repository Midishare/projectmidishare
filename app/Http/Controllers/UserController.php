<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $users = User::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('nik', 'LIKE', "%{$query}%")
                        ->orWhere('lokasi', 'LIKE', "%{$query}%")
                        ->orWhere('branch', 'LIKE', "%{$query}%")
                        ->with('address')
                        ->get();
        } else {
            $users = User::with('address')->get();
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $address = $user->address;

        if ($address === null) {
            return redirect()->route('addresses.create')->with('warning', 'Alamat pengguna belum tersedia. Harap tambahkan alamat terlebih dahulu.');
        }

        return view('users.show', compact('user', 'address'));
    }

    public function showProfile()
    {
        $user = Auth::user();
        $address = $user->address;
        if ($address === null) {
            return redirect()->route('dashboard')->with('alamatKosong', 'Kamu belum memiliki alamat, minta admin membuatkan');
        }
        if ($user->hasRole('admin')) {
            return view('users.profile-admin', compact('user', 'address'));
        } elseif ($user->hasRole('user')) {
            return view('users.profile-user', compact('user', 'address'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'lokasi' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        $userRole = Role::where('name','user')->first();
        $user->assignRole($userRole);
        if($user->hasRole('user')){
        return redirect()->route('users.index')->with('success', 'User created successfully.');
        }else{
        var_dump($user);
        }
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|min:7',
            'password' => 'required|string|min:8',
            // 'lokasi' => 'required|string|max:255',
            // 'branch' => 'required|string|max:255',
        ]);


        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Periksa relasi dengan tabel teachers
        if ($user->address()->exists()) {
            $user->address()->delete(); // Hapus data di tabel teachers jika ada relasi
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function deleteCheckedUser(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Users have been deleted!"]);
    }
    

    // Method untuk menampilkan form import
    public function showImportForm()
    {
        return view('users.import'); // Ganti 'users.import' dengan nama view yang kamu inginkan
    }

    // Method untuk memproses import data pengguna
    // Method untuk memproses import data pengguna
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls', // Validasi file hanya boleh format Excel (xlsx, xls)
        ]);

        $file = $request->file('file');

        // Proses import menggunakan package Laravel Excel
        Excel::import(new UserImport, $file);

        $userRole = Role::where('name', 'user')->first();
        $users = User::all(); // Ambil semua data pengguna setelah proses import
        foreach ($users as $user) {
            $user->assignRole($userRole);
        }

        return redirect()->route('users.index')->with('success', 'Users imported successfully.');
}

}