<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;


// class AuthController extends Controller
// {
//     public function showLoginForm()
//     {
//         $user = User::count();
//         return view('auth.login', compact('user'));
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->only('nik', 'password');

//         if (Auth::attempt($credentials)) {
//             return redirect()->intended(route('dashboard'));
//         } else {
//             return redirect()->back()->withInput()->withErrors(['nik' => 'Nik atau password salah']);
//         }
//     }

//     public function logout()
//     {
//         Auth::logout();
//         return redirect('login');
//     }
// }

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
            // Log the login event
            Login::create(['user_id' => Auth::id()]);
            
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()->back()->withInput()->withErrors(['nik' => 'Nik atau password salah']);
        }
    }

    public function logout()
    {
        // Log the logout event
        Logout::create(['user_id' => Auth::id()]);
        
        Auth::logout();
        return redirect('login');
    }
}
