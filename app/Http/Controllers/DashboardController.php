<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Login;
use App\Models\Logout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $jml_user = User::count();
        $hari_ini = Carbon::today();
        $jml_perhari = User::whereDate('created_at', $hari_ini)->count();
        $home = DB::table('home')->orderBy('id', 'desc')->get();
        $onlineUsersCount = $this->countOnlineUsersToday();

        // Cek apakah user memiliki role admin atau auditor
        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('auditor'))) {
            return view('welcomeadmin', compact('jml_user', 'jml_perhari', 'onlineUsersCount', 'home'));
        } else {
            return view('welcome', compact('home'));
        }
    }


    public function countOnlineUsersToday()
    {
        $today = Carbon::today();
        $loginsToday = Login::whereDate('created_at', $today)->get();
        $onlineUsersCount = 0;

        foreach ($loginsToday as $login) {
            $logout = Logout::where('user_id', $login->user_id)
                ->whereDate('created_at', $today)
                ->first();
            if (!$logout || $logout->created_at > $login->created_at) {
                $onlineUsersCount++;
            }
        }

        return $onlineUsersCount;
    }
}
