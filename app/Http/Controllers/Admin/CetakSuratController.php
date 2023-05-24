<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Novay\WordTemplate\WordTemplate;

class CetakSuratController extends Controller
{
    public function index()
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();

        if (Auth::user()->role == 'Admin' || Auth::user()->role == 'BK') {
            $items = Siswa::join('kelas_siswa', 'kelas_siswa.nisn', 'siswa.nisn')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->join('siswa_pelanggaran', 'siswa_pelanggaran.kelas_siswa_id', 'kelas_siswa.id')->distinct('siswa.nisn')->get('siswa.*');
        } else {
            $items = Siswa::join('kelas_siswa', 'kelas_siswa.nisn', 'siswa.nisn')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->join('siswa_pelanggaran', 'siswa_pelanggaran.kelas_siswa_id', 'kelas_siswa.id')->where('kelas.wali_kelas', Auth::user()->id)->distinct('siswa.nisn')->get('siswa.*');
        }

        return view('pages.cetak-surat.index', compact('items'));
    }

    public function cetak_surat_rekomendasi(Request $request)
    {
        $item = Siswa::findOrFail($request->nisn);

        $pelanggaran = Pelanggaran::findOrFail($item->pelanggaran($item->nisn)->pelanggaran->id);
		$nama_ayah = $request->nama_ayah;
		$nama_ibu = $request->nama_ibu;
		$nama_wali = $request->nama_wali;
		$alamat = $request->alamat;
		$jumlah_hari = $request->jumlah_hari;
		$tanggal_awal = $request->tanggal_awal;
		$tanggal_akhir = $request->tanggal_akhir;

		return view('pages.cetak-surat.surat_rekomendasi', compact('item', 'nama_ayah', 'nama_ibu', 'nama_wali', 'alamat', 'jumlah_hari', 'tanggal_awal', 'tanggal_akhir', 'pelanggaran'));
    }

    public function cetak_surat_pernyataan_orang_tua(Request $request)
    {
        $item = Siswa::findOrFail($request->nisn);

        $nama = $request->nama;
        $jenis_kelamin = $request->jenis_kelamin;
        $pekerjaan = $request->pekerjaan;
        $no_hp = $request->no_hp;
        $alamat = $request->alamat;

        return view('pages.cetak-surat.surat_pernyataan_orang_tua', compact('item', 'nama', 'jenis_kelamin', 'pekerjaan', 'no_hp', 'alamat'));
    }

    public function cetak_surat_pernyataan_siswa(Request $request)
    {
        $item = Siswa::findOrFail($request->nisn);

        $nama = $request->nama;
        $pekerjaan = $request->pekerjaan;
        $alamat = $request->alamat;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $tinggal_bersama = $request->tinggal_bersama;

        return view('pages.cetak-surat.surat_pernyataan_siswa', compact('item', 'nama', 'pekerjaan', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'tinggal_bersama'));
    }
}
