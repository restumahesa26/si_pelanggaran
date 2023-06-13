<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\SiswaPelanggaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        if (Auth::user()->role == 'Admin' || Auth::user()->role == 'BK') {
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->latest('created_at')->paginate(10, 'siswa_pelanggaran.*');

            $kelas = Kelas::where('tahun_ajaran_id', $tahunAjaran->id)->get();
        } else {
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas.wali_kelas', Auth::user()->id)->latest('created_at')->paginate(10, 'siswa_pelanggaran.*');

            $kelas = NULL;
        }

        return view('pages.laporan.index', compact('items', 'kelas'));
    }

    public function cetak()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        if (Auth::user()->role == 'Admin' || Auth::user()->role == 'BK') {
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->latest('created_at')->get('siswa_pelanggaran.*');
        } else {
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas.wali_kelas', Auth::user()->id)->latest('created_at')->get('siswa_pelanggaran.*');
        }

        return view('pages.laporan.pdf', compact('items'));
    }

    public function cetak2(Request $request)
    {
        $item = Kelas::findOrFail($request->kelas);

        $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.id', $request->kelas)->latest('created_at')->get('siswa_pelanggaran.*');

        return view('pages.laporan.pdf-2', compact('items', 'item'));
    }
}
