<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = TahunAjaran::latest('created_at')->get();

        return view('pages.data-tahun-ajaran.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => ['required', 'string', 'max:255', 'unique:tahun_ajaran'],
            'status' => ['required', 'in:0,1'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status,
        ]);

        Alert::toast('Berhasil Menambah Data Tahun Ajaran', 'success')->position('top');
        return redirect()->route('data-tahun-ajaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = TahunAjaran::findOrFail($id);

        return view('pages.data-tahun-ajaran.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = TahunAjaran::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:0,1'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($item->tahun_ajaran != $request->tahun_ajaran) {
            $validator2 = Validator::make($request->all(), [
                'tahun_ajaran' => ['required', 'string', 'max:255', 'unique:tahun_ajaran'],
            ]);

            if ($validator2->fails()) {
                Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
                return redirect()->back()->withErrors($validator2)->withInput();
            }
        }

        $check = TahunAjaran::where('status', '1')->count();

        if ($request->status == '1') {
            if ($item->status == '1') {
                $item->update([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'status' => $request->status,
                ]);
            }elseif ($check > 0) {
                Alert::toast('Tahun Ajaran Aktif Sudah Tersedia', 'error')->position('top');
                return redirect()->back()->withInput();
            } else {
                $item->update([
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'status' => $request->status,
                ]);
            }
        }else {
            $item->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'status' => $request->status,
            ]);
        }

        Alert::toast('Berhasil Mengubah Data Tahun Ajaran', 'success')->position('top');
        return redirect()->route('data-tahun-ajaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = TahunAjaran::findOrFail($id);

        $item->delete();

        Alert::toast('Berhasil Menghapus Data Tahun Ajaran', 'success')->position('top');
        return redirect()->route('data-tahun-ajaran.index');
    }

    public function change(Request $request)
    {
        $item = TahunAjaran::findOrFail($request->id);
        $item2 = TahunAjaran::where('status', '1')->first();

        $item->update([
            'status' => '1'
        ]);

        $item2->update([
            'status' => '0'
        ]);

        Alert::toast('Berhasil Mengganti Data Tahun Ajaran', 'success')->position('top');
        return redirect()->route('data-tahun-ajaran.index');
    }
}
