<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class LinkogmController extends Controller
{
    public function showlinkogm(Request $request)
    {
        $search = $request->input('search');

        $linkogm = DB::table('linkogm')
            ->when($search, function ($query, $search) {
                return $query->where('judullinkogm', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('ogmlink', ['linkogm' => $linkogm]);
    }

    public function addlinkogm_process(Request $request)
    {
        $request->validate([
            'judullinkogm' => 'required',
            'linkdriveogm' => 'required|url',
        ]);

        try {
            DB::table('linkogm')->insert([
                'judullinkogm' => $request->input('judullinkogm'),
                'linkdriveogm' => $request->input('linkdriveogm'),
            ]);

            return redirect()->route('linkogm.show_by_adminlinkogmshow')->with('success', 'Link berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function addlinkogm()
    {
        return view('addlinkogm');
    }

    public function detaillinkogm($id)
    {
        $linkogm = DB::table('linkogm')->where('id', $id)->first();
        return view('detaillinkogm', ['linkogm' => $linkogm]);
    }

    public function show_by_adminlinkogmshow(Request $request)
    {
        $search = $request->input('search');
        $linkogm = DB::table('linkogm')
            ->when($search, function ($query, $search) {
                return $query->where('judullinkogm', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('showlinkogm', ['linkogm' => $linkogm]);
    }

    public function editlinkogm($id)
    {
        $linkogm = DB::table('linkogm')->where('id', $id)->first();
        return view('editlinkogm', ['linkogm' => $linkogm]);
    }

    public function editlinkogm_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judullinkogm' => 'required',
            'linkdriveogm' => 'required|url',
        ]);

        $id = $request->id;
        $judullinkogm = $request->judullinkogm;
        $linkogm = DB::table('linkogm')->where('id', $id)->first();
        if (!$linkogm) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        try {
            DB::table('linkogm')->where('id', $id)->update([
                'judullinkogm' => $judullinkogm,
                'linkdriveogm' => $request->input('linkdriveogm'),
            ]);
            Session::flash('success', 'Link Dokumen berhasil diupdate.');
            return redirect()->route('linkogm.show_by_adminlinkogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletelinkogm($id)
    {
        $linkogm = DB::table('linkogm')->where('id', $id)->first();

        try {
            DB::table('linkogm')->where('id', $id)->delete();

            Session::flash('success', 'Video berhasil dihapus.');
            return redirect()->route('linkogm.show_by_adminlinkshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedItems = $request->selectedItems;

        try {
            DB::table('linkogm')->whereIn('id', $selectedItems)->delete();
            Session::flash('success', 'Link terpilih berhasil dihapus.');
            return redirect()->route('linkogm.show_by_adminlinkogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
