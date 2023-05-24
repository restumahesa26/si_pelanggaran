<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SiswaKelasImport;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();

        $items = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)->get();
        $waliKelas = User::where('role', 'Wali Kelas')->get();

        return view('pages.data-kelas.index', compact('items', 'waliKelas'));
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
            'jenjang' => ['required', 'in:X,XI,XII'],
            'kelas' => ['required', 'string', 'max:255'],
            'wali_kelas' => ['required'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tahunAjaran = TahunAjaran::where('status', '1')->first();

        Kelas::create([
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'wali_kelas' => $request->wali_kelas,
            'tahun_ajaran_id' => $tahunAjaran->id
        ]);

        Alert::toast('Berhasil Menambah Data Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Kelas::findOrFail($id);
        $siswa = Siswa::orderBy('nama', 'ASC')->get();

        return view('pages.data-kelas.show', compact('item', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Kelas::findOrFail($id);
        $waliKelas = User::where('role', 'Wali Kelas')->get();

        return view('pages.data-kelas.edit', compact('item', 'waliKelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'jenjang' => ['required', 'in:X,XI,XII'],
            'kelas' => ['required', 'string', 'max:255'],
            'wali_kelas' => ['required'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Kelas::findOrFail($id);

        $item->update([
            'jenjang' => $request->jenjang,
            'kelas' => $request->kelas,
            'wali_kelas' => $request->wali_kelas,
        ]);

        Alert::toast('Berhasil Mengubah Data Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Kelas::findOrFail($id);

        $item->delete();

        Alert::toast('Berhasil Menghapus Data Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.index');
    }

    public function store_siswa_kelas(Request $request)
    {
        foreach ($request->nisn as $value) {
            $check = KelasSiswa::where('nisn', $value)->where('kelas_id', $request->kelas_id)->first();

            $tahunAjaran = TahunAjaran::where('status', '1')->first();

            $check2 = KelasSiswa::join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
                ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
                ->where('nisn', $value)
                ->first();

            if ($check != NULL || $check2 != NULL) {
                Alert::toast('Siswa Kelas Sudah Tersedia', 'error')->position('top');
                return redirect()->back()->withInput();
            } else {
                KelasSiswa::create([
                    'nisn' => $value,
                    'kelas_id' => $request->kelas_id
                ]);
            }
        }

        Alert::toast('Berhasil Menambah Siswa Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.show', $request->kelas_id);
    }

    public function destroy_siswa_kelas(string $id)
    {
        $item = KelasSiswa::findOrFail($id);

        $kelas_id = $item->kelas_id;

        $item->delete();

        Alert::toast('Berhasil Menghapus Siswa Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.show', $kelas_id);
    }

    public function import_siswa_kelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => ['required', 'file', 'mimes:xlx,xls,xlsx']
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Excel::import(new SiswaKelasImport($request->kelas_id), $request->file('file'));

        Alert::toast('Berhasil Import Data Siswa Kelas', 'success')->position('top');
        return redirect()->route('data-kelas.show', $request->kelas_id);
    }
}
