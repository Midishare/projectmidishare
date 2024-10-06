<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class LinkmodController extends Controller
{
    public function showlinkmod(Request $request)
    {
        $search = $request->input('search');

        $linkmod = DB::table('linkmod')
            ->when($search, function ($query, $search) {
                return $query->where('judullinkmod', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('modlink', ['linkmod' => $linkmod]);
    }

    public function addlinkmod()
    {
        return view('addlinkmod');
    }

    public function addlinkmod_process(Request $request)
    {
        $request->validate([
            'judullinkmod' => 'required',
            'linkdrivemod' => 'required|url',
        ]);

        try {
            DB::table('linkmod')->insert([
                'judullinkmod' => $request->input('judullinkmod'),
                'linkdrivemod' => $request->input('linkdrivemod'),
            ]);

            return redirect()->route('linkmod.show_by_adminlinkshow')->with('success', 'Link berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function detaillinkmod($id)
    {
        $linkmod = DB::table('linkmod')->where('id', $id)->first();
        return view('detaillinkmod', ['linkmod' => $linkmod]);
    }

    public function show_by_adminlinkshow(Request $request)
    {
        $search = $request->input('search');
        $linkmod = DB::table('linkmod')
            ->when($search, function ($query, $search) {
                return $query->where('judullinkmod', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('showlinkmod', ['linkmod' => $linkmod]);
    }

    public function editlinkmod($id)
    {
        $linkmod = DB::table('linkmod')->where('id', $id)->first();
        return view('editlinkmod', ['linkmod' => $linkmod]);
    }

    public function editlink_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judullinkmod' => 'required',
            'linkdrivemod' => 'required|url',
        ]);

        $id = $request->id;
        $judullinkmod = $request->judullinkmod;
        $linkmod = DB::table('linkmod')->where('id', $id)->first();
        if (!$linkmod) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        try {
            DB::table('linkmod')->where('id', $id)->update([
                'judullinkmod' => $judullinkmod,
                'linkdrivemod' => $request->input('linkdrivemod'),
            ]);
            Session::flash('success', 'Link Dokumen berhasil diupdate.');
            return redirect()->route('linkmod.show_by_adminlinkshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletelinkmod($id)
    {
        $linkmod = DB::table('linkmod')->where('id', $id)->first();

        try {
            DB::table('linkmod')->where('id', $id)->delete();

            Session::flash('success', 'Video berhasil dihapus.');
            return redirect()->route('linkmod.show_by_adminlinkshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            DB::table('linkmod')->whereIn('id', $ids)->delete();
            return redirect()->route('linkmod.show_by_adminlinkshow')->with('success', 'Berhasil Dihapus');
        }

        return redirect()->route('linkmod.show_by_adminlinkshow')->with('error', 'No items selected for deletion.');
    }
}
