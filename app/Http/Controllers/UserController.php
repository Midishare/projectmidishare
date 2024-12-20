<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                ->orWhere('jabatan', 'LIKE', "%{$query}%")
                ->paginate(10);
        } else {
            $users = User::paginate(10);
        }

        return view('users.index', compact('users'));
    }


    public function create()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini');
        }

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
            'nik' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,auditor',
        ]);

        $user = User::create($validatedData);
        $user->assignRole($validatedData['role']);
        if ($user->hasRole('user')) {
            return redirect()->route('users.index')->with('success', 'User ini created successfully.');
        } elseif ($user->hasRole('auditor')) {
            return redirect()->route('users.index')->with('success', 'auditor created successfully.');
        } else {
            var_dump($user);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|min:7',
            'lokasi' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'class' => 'required|string|max:10',
            'role' => 'required|in:user,auditor',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $validatedData['name'];
        $user->nik = $validatedData['nik'];
        $user->lokasi = $validatedData['lokasi'];
        $user->branch = $validatedData['branch'];
        $user->jabatan = $validatedData['jabatan'];
        $user->class = $validatedData['class'];

        if ($request->filled('password')) {
            $user->password = $validatedData['password'];
        }
        $user->class = ($request->class == 'None') ? null : $request->class;
        $user->syncRoles([$validatedData['role']]);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->address()->exists()) {
            $user->address()->delete();
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

    public function showImportForm()
    {
        return view('users.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        Excel::import(new UserImport, $file);

        $userRole = Role::where('name', 'user')->first();
        $users = User::whereDoesntHave('roles')->get();

        foreach ($users as $user) {
            $user->assignRole($userRole);
        }

        return redirect()->route('users.index')->with('success', 'Users imported successfully.');
    }
}
