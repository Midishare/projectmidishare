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

        if (Auth::check() && Auth::user()->hasRole('admin')) {
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

    // public function showhome()
    // {
    //     $home = DB::table('home')->orderBy('id', 'desc')->get();
    //     return view('welcome', ['home' => $home]);
    // }

    public function show_by_adminhomeshow()
    {
        $home = DB::table('home')->orderBy('id', 'desc')->paginate(6);
        return view('showhome', ['home' => $home]);
    }

    public function showhome()
    {
        $home = DB::table('home')->orderBy('id', 'desc')->paginate(6);
        return view('welcome', ['home' => $home]);
    }

    public function addhome()
    {
        $home = DB::table('home')->orderBy('id', 'desc')->get();
        return view('addhome');
    }

    public function addhome_process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $gambarPath = $request->file('image')->store('public/gambar');
            $gambarNama = basename($gambarPath);

            DB::table('home')->insert([
                'image' => $gambarNama,
            ]);

            Session::flash('success', 'Gambar berhasil ditambahkan.');
            return redirect()->action([DashboardController::class, 'show_by_adminhomeshow']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function edithome($id)
    {
        $home = DB::table('home')->where('id', $id)->first();
        return view('edithome', ['home' => $home]);
    }

    public function edithome_process(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $id = $request->id;

            $home = DB::table('home')->where('id', $id)->first();
            $gambarLama = $home->image;

            $updateData = [];

            if ($request->hasFile('image')) {
                $gambarPath = $request->file('image')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['image'] = $gambarNama;

                Storage::delete('public/gambar/' . $gambarLama);
            }

            DB::table('home')->where('id', $id)->update($updateData);

            Session::flash('success', 'Berhasil diedit.');
            return redirect()->route('dashboard.show_by_adminhomeshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletehome($id)
    {
        try {
            $home = DB::table('home')->where('id', $id)->first();
            if ($home->image) {
                Storage::delete('public/gambar/' . $home->image);
            }
            DB::table('home')->where('id', $id)->delete();
            Session::flash('success', 'Item berhasil dihapus.');
            return redirect()->action([DashboardController::class, 'show_by_adminhomeshow']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function deleteSelectedHome(Request $request)
    {
        try {
            $ids = $request->input('ids');
            if (!empty($ids)) {
                $homes = DB::table('home')->whereIn('id', $ids)->get();
                foreach ($homes as $home) {
                    if ($home->image) {
                        Storage::delete('public/gambar/' . $home->image);
                    }
                }
                DB::table('home')->whereIn('id', $ids)->delete();
                Session::flash('success', 'Berhasil dihapus.');
            } else {
                Session::flash('error', 'No items selected for deletion.');
            }
            return redirect()->action([DashboardController::class, 'show_by_adminhomeshow']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }
}
