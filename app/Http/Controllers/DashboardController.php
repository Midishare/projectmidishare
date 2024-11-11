<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Login;
use App\Models\LoginActivity;
use Stevebauman\Location\Facades\Location;
use App\Models\Logout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $currentSessions = $this->getCurrentSessions() ?? [];
        $weeklyLogins = $this->getWeeklyLogins() ?? [];
        $jml_user = User::count();
        $hari_ini = Carbon::today();
        $jml_perhari = User::whereDate('created_at', $hari_ini)->count();
        $home = DB::table('home')->orderBy('id', 'desc')->get();
        $onlineUsersCount = $this->countOnlineUsersToday();

        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('auditor'))) {
            return view('welcomeadmin', compact('jml_user', 'jml_perhari', 'onlineUsersCount', 'home', 'currentSessions', 'weeklyLogins'));
        } else {
            return view('welcome', compact('home'));
        }
    }

    public function loginDetection()
    {
        $currentSessions = LoginActivity::with('user')
            ->currentlyActive()
            ->get()
            ->map(function ($activity) {
                return [
                    'user_name' => $activity->user->name,
                    'nik' => $activity->user->nik,
                    'ip_address' => $activity->ip_address,
                    'device' => $this->getDeviceName($activity), // Updated to use device name function
                    'browser' => $activity->browser,
                    'login_time' => Carbon::parse($activity->login_at)->diffForHumans(),
                ];
            });

        $weeklyLogins = LoginActivity::with('user')
            ->where('login_at', '>=', now()->subWeek())
            ->orderBy('login_at', 'desc')
            ->get()
            ->groupBy(function ($activity) {
                return Carbon::parse($activity->login_at)->format('Y-m-d');
            })
            ->map(function ($dailyLogins) {
                return $dailyLogins->map(function ($activity) {
                    return [
                        'user_name' => $activity->user->name,
                        'nik' => $activity->user->nik,
                        'login_time' => Carbon::parse($activity->login_at)->format('d-m-Y H:i:s'),
                        'device' => $this->getDeviceName($activity), // Updated to use device name function
                        'status' => $activity->status,
                    ];
                });
            });

        return view('admin.login-detection', [
            'currentSessions' => $currentSessions,
            'weeklyLogins' => $weeklyLogins
        ]);
    }

    protected function getDeviceName($activity)
    {
        // Modify this function to retrieve the device name.
        // Assuming `device` in `LoginActivity` stores the device name, simply return it:
        return $activity->device ?? 'Unknown Device';
    }

    protected function getCurrentSessions()
    {
        return LoginActivity::with('user')
            ->currentlyActive()
            ->get()
            ->map(function ($activity) {
                return [
                    'user_name' => $activity->user->name,
                    'email' => $activity->user->email,
                    'ip_address' => $activity->ip_address,
                    'device' => $this->getDeviceName($activity), // Updated to use device name function
                    'browser' => $activity->browser,
                    'login_time' => Carbon::parse($activity->login_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s'),
                ];
            });
    }

    protected function getWeeklyLogins()
    {
        return LoginActivity::with('user')
            ->where('login_at', '>=', now()->subWeek())
            ->orderBy('login_at', 'desc')
            ->get()
            ->groupBy(function ($activity) {
                return Carbon::parse($activity->login_at)->timezone('Asia/Jakarta')->format('Y-m-d');
            })
            ->map(function ($dailyLogins) {
                return $dailyLogins->map(function ($activity) {
                    return [
                        'user_name' => $activity->user->name,
                        'nik' => $activity->user->nik,
                        'login_time' => Carbon::parse($activity->login_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s'),
                        'device' => $this->getDeviceName($activity), // Updated to use device name function
                        'status' => $activity->status,
                    ];
                });
            });
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
