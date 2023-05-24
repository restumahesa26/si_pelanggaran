<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\SiswaKeputusan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaKeputusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        if (Auth::user()->role == 'BK') {
            $items = Siswa::join('kelas_siswa', 'kelas_siswa.nisn', 'siswa.nisn')->join('siswa_pelanggaran', 'siswa_pelanggaran.kelas_siswa_id', 'kelas_siswa.id')->whereNotNull('siswa_pelanggaran.id', NULL)->distinct('siswa.nisn')->get('siswa.*');
            $siswa = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->get('kelas_siswa.*');
        } else {
            $items = Siswa::join('kelas_siswa', 'kelas_siswa.nisn', 'siswa.nisn')->join('siswa_pelanggaran', 'siswa_pelanggaran.kelas_siswa_id', 'kelas_siswa.id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.wali_kelas', Auth::user()->id)->distinct('siswa.nisn')->get('siswa.*');
            $siswa = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas.wali_kelas', Auth::user()->id)->get('kelas_siswa.*');
        }

        return view('pages.keputusan-siswa.index', compact('items', 'siswa'));
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
            'kelas_siswa_id' => ['required'],
            'keputusan' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SiswaKeputusan::create([
            'user_id' => Auth::user()->id,
            'kelas_siswa_id' => $request->kelas_siswa_id,
            'keputusan' => $request->keputusan
        ]);

        Alert::toast('Berhasil Menambah Keputusan', 'success')->position('top');
        return redirect()->route('keputusan-siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $items = SiswaKeputusan::join('kelas_siswa', 'kelas_siswa.id', 'siswa_keputusan.kelas_siswa_id')->where('kelas_siswa.nisn', $id)->get('siswa_keputusan.*');

        $item = Siswa::findOrFail($id);

        return view('pages.keputusan-siswa.show', compact('items', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item2 = SiswaKeputusan::findOrFail($id);

        $nisn = $item2->kelas_siswa->nisn;

        $items = SiswaKeputusan::join('kelas_siswa', 'kelas_siswa.id', 'siswa_keputusan.kelas_siswa_id')->where('kelas_siswa.nisn', '123457')->get('siswa_keputusan.*');

        $item = Siswa::findOrFail($nisn);

        return view('pages.keputusan-siswa.edit', compact('items', 'item2', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'keputusan' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = SiswaKeputusan::findOrFail($id);

        $nisn = $item->kelas_siswa->nisn;

        $item->update([
            'keputusan' => $request->keputusan
        ]);

        Alert::toast('Berhasil Mengubah Keputusan', 'success')->position('top');
        return redirect()->route('keputusan-siswa.show', $nisn);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = SiswaKeputusan::findOrFail($id);

        $nisn = $item->kelas_siswa->nisn;

        $item->delete();

        Alert::toast('Berhasil Menghapus Keputusan', 'success')->position('top');
        return redirect()->route('keputusan-siswa.show', $nisn);
    }
}
