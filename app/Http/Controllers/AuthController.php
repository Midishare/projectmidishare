<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Login;  // Import the Login model
use App\Models\Logout; // Import the Logout model

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $user = User::count();
        return view('auth.login', compact('user'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (Auth::attempt($credentials)) {
            // Log login event
            Login::create(['user_id' => Auth::id()]);

            $user = Auth::user();

            if ($user->hasRole('admin') || $user->hasRole('auditor')) {
                return redirect()->intended(route('dashboard')); // Arahkan admin & auditor ke dashboard admin
            } else {
                return redirect()->intended(route('dashboard')); // Arahkan user biasa ke halaman user
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['nik' => 'Nik atau password salah']);
        }
    }

    public function logout()
    {
        // Log the logout event
        Logout::create(['user_id' => Auth::id()]);

        Auth::logout();
        return redirect()->route('welcome');
    }
}
