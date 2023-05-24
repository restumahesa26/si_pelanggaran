<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Pelanggaran::orderBy('skor', 'ASC')->get();

        return view('pages.data-pelanggaran.index', compact('items'));
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
            'pelanggaran' => ['required', 'string', 'max:255'],
            'skor' => ['required', 'numeric'],
            'ayat' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pelanggaran::create([
            'pelanggaran' => $request->pelanggaran,
            'skor' => $request->skor,
            'ayat' => $request->ayat,
        ]);

        Alert::toast('Berhasil Menambah Data Pelanggaran', 'success')->position('top');
        return redirect()->route('data-pelanggaran.index');
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
        $item = Pelanggaran::findOrFail($id);

        return view('pages.data-pelanggaran.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'pelanggaran' => ['required', 'string', 'max:255'],
            'skor' => ['required', 'numeric'],
            'ayat' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Pelanggaran::findOrFail($id);

        $item->update([
            'pelanggaran' => $request->pelanggaran,
            'skor' => $request->skor,
            'ayat' => $request->ayat,
        ]);

        Alert::toast('Berhasil Mengubah Data Pelanggaran', 'success')->position('top');
        return redirect()->route('data-pelanggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Pelanggaran::findOrFail($id);

        $item->delete();

        Alert::toast('Berhasil Menghapus Data Pelanggaran', 'success')->position('top');
        return redirect()->route('data-pelanggaran.index');
    }
}
