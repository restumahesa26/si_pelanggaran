<?php

namespace App\Helper;

use App\Models\Pelanggaran;
use App\Models\SiswaPelanggaran;
use App\Models\TahunAjaran;

class Helper
{
    public static function getTahunAjaran()
    {
        $item = TahunAjaran::where('status', '1')->first();

        return $item->tahun_ajaran;
    }

    public static function getPelanggaran($id)
    {
        $item = SiswaPelanggaran::join('kelas_siswa', 'kelas_siswa.id', 'siswa_pelanggaran.kelas_siswa_id')->join('kelas', 'kelas.id', 'kelas_siswa.kelas_id')->where('kelas.tahun_ajaran_id', $id)->count();

        return $item;
    }
}
