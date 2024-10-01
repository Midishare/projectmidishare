<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LinkwhController extends Controller
{
    public function showlinkwh(Request $request)
    {
        $search = $request->input('search');

        $linkwh = DB::table('linkwh')
                        ->when($search, function($query, $search) {
                            return $query->where('judullinkwh', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('whlink', ['linkwh' => $linkwh]);
    }

    public function addlinkwh_process(Request $request)
    {
        $request->validate([
            'judullinkwh' => 'required',
            'linkdrivewh' => 'required|url', 
        ]);

        try {
            DB::table('linkwh')->insert([
                'judullinkwh' => $request->input('judullinkwh'),
                'linkdrivewh' => $request->input('linkdrivewh'),
            ]);

            return redirect()->route('linkwh.show_by_adminlinkwhshow')->with('success', 'Link berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function addlinkwh()
    {
        return view('addlinkwh');
    }

    public function detaillinkwh($id)
    {
        $linkwh = DB::table('linkwh')->where('id', $id)->first();
        return view('detaillinkwh', ['linkwh' => $linkwh]);
    }

    public function show_by_adminlinkwhshow(Request $request)
    {
        $search = $request->input('search');
        $linkwh = DB::table('linkwh')
                        ->when($search, function($query, $search) {
                            return $query->where('judullinkwh', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(9);
        
        return view('showlinkwh', ['linkwh' => $linkwh]);
    }

    public function editlinkwh($id)
    {
        $linkwh = DB::table('linkwh')->where('id', $id)->first();
        return view('editlinkwh', ['linkwh' => $linkwh]);
    }
    
    public function editlinkwh_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judullinkwh' => 'required',
            'linkdrivewh' => 'required|url', 
        ]);
    
        $id = $request->id;
        $judullinkwh = $request->judullinkwh;
        $linkwh = DB::table('linkwh')->where('id', $id)->first();
        if (!$linkwh) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data tidak ditemukan.']);
        }
    
        try {
            DB::table('linkwh')->where('id', $id)->update([
                'judullinkwh' => $judullinkwh,
                'linkdrivewh' => $request->input('linkdrivewh'),
            ]);
            Session::flash('success', 'Link Dokumen berhasil diupdate.');
            return redirect()->route('linkwh.show_by_adminlinkwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }    

    public function deletelinkwh($id)
    {
        $linkwh = DB::table('linkwh')->where('id', $id)->first();
    
        try {
            DB::table('linkwh')->where('id', $id)->delete();
    
            Session::flash('success', 'Video berhasil dihapus.');
            return redirect()->route('linkwh.show_by_adminlinkshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deleteSelectedwh(Request $request)
    {
        $selectedItems = $request->selectedItems;

        try {
            DB::table('linkwh')->whereIn('id', $selectedItems)->delete();
            Session::flash('success', 'Berhasil dihapus.');
            return redirect()->route('linkwh.show_by_adminlinkwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
