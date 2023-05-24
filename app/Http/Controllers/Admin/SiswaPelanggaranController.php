<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KelasSiswa;
use App\Models\Pelanggaran;
use App\Models\SiswaPelanggaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaPelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        $pelanggaran = Pelanggaran::orderBy('skor', 'ASC')->get();
        if (Auth::user()->role == 'BK') {
            $siswa = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->get('kelas_siswa.*');
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->latest('created_at')->get('siswa_pelanggaran.*');
        } else {
            $siswa = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas.wali_kelas', Auth::user()->id)->get('kelas_siswa.*');
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas.wali_kelas', Auth::user()->id)->latest('created_at')->get('siswa_pelanggaran.*');
        }

        return view('pages.pelanggaran-siswa.index', compact('items', 'siswa', 'pelanggaran'));
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
            'pelanggaran_id' => ['required'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SiswaPelanggaran::create([
            'user_id' => Auth::user()->id,
            'kelas_siswa_id' => $request->kelas_siswa_id,
            'pelanggaran_id' => $request->pelanggaran_id,
        ]);

        Alert::toast('Berhasil Menambah Pelanggaran Siswa', 'success')->position('top');
        return redirect()->route('pelanggaran-siswa.index');
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
        $item = SiswaPelanggaran::findOrFail($id);
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        $siswa = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->get('kelas_siswa.*');
        $pelanggaran = Pelanggaran::orderBy('skor', 'ASC')->get();

        return view('pages.pelanggaran-siswa.edit', compact('item', 'siswa', 'pelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'kelas_siswa_id' => ['required'],
            'pelanggaran_id' => ['required'],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = SiswaPelanggaran::findOrFail($id);

        $item->update([
            'kelas_siswa_id' => $request->kelas_siswa_id,
            'pelanggaran_id' => $request->pelanggaran_id,
        ]);

        Alert::toast('Berhasil Mengubah Pelanggaran Siswa', 'success')->position('top');
        return redirect()->route('pelanggaran-siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = SiswaPelanggaran::findOrFail($id);

        $item->delete();

        Alert::toast('Berhasil Menghapus Pelanggaran Siswa', 'success')->position('top');
        return redirect()->route('pelanggaran-siswa.index');
    }
}
