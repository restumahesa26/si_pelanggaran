<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $check = Siswa::where('nisn', $row[0])->first();

        if ($check == NULL) {
            return new Siswa([
                'nisn' => $row[0],
                'nama' => $row[1],
                'jenis_kelamin' => $row[2],
            ]);
        }
    }
}
