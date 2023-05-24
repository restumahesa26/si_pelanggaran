<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KelasSiswa;
use App\Models\SiswaPelanggaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $tahunAjaran = TahunAjaran::orderBy('tahun_ajaran', 'ASC')->get();
        $id = TahunAjaran::where('status', '1')->first();
        $items2 = NULL;
        if (Auth::user()->role == 'Admin' || Auth::user()->role == 'BK') {
            $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $id->id)->orderBy('created_at', 'DESC')->paginate(10, 'siswa_pelanggaran.*');
        } else {
            $items = KelasSiswa::join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.wali_kelas', Auth::user()->id)->join('siswa', 'siswa.nisn', 'kelas_siswa.nisn')->orderBy('siswa.nama')->get();
            $items2 = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $id->id)->where('kelas.wali_kelas', Auth::user()->id)->orderBy('created_at', 'DESC')->get('siswa_pelanggaran.*');
        }

        return view('pages.dashboard', compact('tahunAjaran', 'items', 'items2'));
    }
}
