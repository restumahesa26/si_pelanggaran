<?php

namespace App\Imports;

use App\Models\KelasSiswa;
use App\Models\TahunAjaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaKelasImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public $kelas_id;

    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    public function model(array $row)
    {
        $check = KelasSiswa::where('nisn', $row[0])->where('kelas_id', $this->kelas_id)->first();
        $tahunAjaran = TahunAjaran::where('status', '1')->first();
        $check2 = KelasSiswa::join('kelas AS kelas', 'kelas.id', '=', 'kelas_siswa.kelas_id')
                ->where('kelas.tahun_ajaran_id', $tahunAjaran->id)
                ->where('nisn', $row[0])
                ->first();

        if ($check == NULL || $check2 == NULL) {
            return new KelasSiswa([
                'nisn' => $row[0],
                'kelas_id' => $this->kelas_id,
            ]);
        }
    }
}
