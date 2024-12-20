<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class LinkogmController extends Controller
{
    public function showlinkogm(Request $request)
    {
        try {
            $search = $request->input('search');

            $linkogm = DB::table('linkogm')
                ->when($search, function ($query, $search) {
                    return $query->where('judullinkogm', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(10);

            return view('ogmlink', ['linkogm' => $linkogm]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }


    public function addlinkogm_process(Request $request)
    {
        $request->validate([
            'judullinkogm' => 'required|string|max:255',
            'linkdriveogm' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $storage_path = storage_path('app/public/dokumen_images');
            if (!file_exists($storage_path)) {
                mkdir($storage_path, 0755, true);
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('dokumen_images', $imageName, 'public');
            } else {
                throw new \Exception('Image file not found in the request.');
            }
            $id = DB::table('linkogm')->insertGetId([
                'judullinkogm' => $request->input('judullinkogm'),
                'linkdriveogm' => $request->input('linkdriveogm'),
                'image_path' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$id) {
                throw new \Exception('Failed to insert data into database.');
            }

            return redirect()->route('linkogm.show_by_adminlinkogmshow')->with('success', 'Link berhasil ditambahkan.');
        } catch (\Exception $e) {


            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $id = $request->id;
        $linkogm = DB::table('linkogm')->where('id', $id)->first();
        if (!$linkogm) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        try {
            if ($request->hasFile('image')) {
                if ($linkogm->image_path) {
                    Storage::disk('public')->delete($linkogm->image_path);
                }
                $imagePath = $request->file('image')->store('dokumen_images', 'public');
                DB::table('linkogm')->where('id', $id)->update([
                    'image_path' => $imagePath,
                ]);
            }

            DB::table('linkogm')->where('id', $id)->update([
                'judullinkogm' => $request->input('judullinkogm'),
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
        if (!$linkogm) {
            return redirect()->back()->withErrors(['error' => 'Data tidak ditemukan.']);
        }

        try {
            if ($linkogm->image_path) {
                Storage::disk('public')->delete($linkogm->image_path);
            }
            DB::table('linkogm')->where('id', $id)->delete();

            Session::flash('success', 'Link berhasil dihapus.');
            return redirect()->route('linkogm.show_by_adminlinkogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function deleteSelected(Request $request)
    {
        $selectedItems = $request->selectedItems;

        $linkogmRecords = DB::table('linkogm')->whereIn('id', $selectedItems)->get();

        try {
            foreach ($linkogmRecords as $linkogm) {
                if ($linkogm->image_path) {
                    Storage::disk('public')->delete($linkogm->image_path);
                }
            }
            DB::table('linkogm')->whereIn('id', $selectedItems)->delete();

            Session::flash('success', 'Link terpilih berhasil dihapus.');
            return redirect()->route('linkogm.show_by_adminlinkogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
