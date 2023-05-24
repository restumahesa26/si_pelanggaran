<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    public $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';

    public $fillable = [
        'nisn', 'nama', 'jenis_kelamin'
    ];

    public function checkSiswa($nisn)
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();

        $item = Siswa::where('siswa.nisn', $nisn)
            ->join('kelas_siswa', 'kelas_siswa.nisn', '=', 'siswa.nisn')
            ->join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
            ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
            ->first();

        if ($item != NULL) {
            return false;
        }else {
            return true;
        }
    }

    public function getKelas($nisn)
    {
        $item = KelasSiswa::where('nisn', $nisn)->orderBy('created_at', 'DESC')->first();

        return $item;
    }

    public function skorSekarang($nisn)
    {
        $tahunAjaran = TahunAjaran::where('status', '1')->first();

        $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $tahunAjaran->id)->where('kelas_siswa.nisn', $nisn)->get('siswa_pelanggaran.*');

        $skor = 0;

        foreach ($items as $value) {
            $skor = $skor + $value->pelanggaran->skor;
        }

        if ($skor != 0) {
            return $skor;
        } else {
            return '-';
        }
    }

    public function totalSkor($nisn)
    {
        $items = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->where('kelas_siswa.nisn', $nisn)->get('siswa_pelanggaran.*');

        $skor = 0;

        foreach ($items as $value) {
            $skor = $skor + $value->pelanggaran->skor;
        }

        if ($skor != 0) {
            return $skor;
        } else {
            return '-';
        }
    }

    public function keputusan($nisn)
    {
        $item = SiswaKeputusan::join('kelas_siswa', 'kelas_siswa.id', 'siswa_keputusan.kelas_siswa_id')->where('kelas_siswa.nisn', $nisn)->orderBy('siswa_keputusan.created_at', 'DESC')->first('siswa_keputusan.*');

        return $item;
    }

    public function pelanggaran($nisn)
    {
        $item = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->where('kelas_siswa.nisn', $nisn)->orderBy('siswa_pelanggaran.created_at', 'DESC')->first('siswa_pelanggaran.*');

        return $item;
    }
}
