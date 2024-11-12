<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Login;  // Import the Login model
use App\Models\LoginActivity;
use App\Models\Logout;
use Carbon\Carbon;

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

            $this->recordLoginActivity($user, $request);
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

        $lastLogin = LoginActivity::where('user_id', Auth::id())
            ->where('status', 'login')
            ->latest()
            ->first();

        if ($lastLogin) {
            $loginTime = Carbon::parse($lastLogin->login_at);
            $logoutTime = now();

            $lastLogin->update([
                'status' => 'logout',
                'logout_at' => $logoutTime,
                'duration_minutes' => $loginTime->diffInMinutes($logoutTime),
                'is_active' => false
            ]);
        }

        Auth::logout();
        return redirect()->route('welcome');
    }


    protected function recordLoginActivity($user, $request)
    {

        LoginActivity::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'status' => 'login',
            'login_at' => now(),
            'is_active' => true
        ]);
    }
}
