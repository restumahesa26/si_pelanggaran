<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MainDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktif = TahunAjaran::create([
            'tahun_ajaran' => '2022-2023',
            'status' => '1'
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => '2021-2022',
            'status' => '0'
        ]);

        User::create([
            'nama' => 'Prabowo',
            'nip' => '123456789123456788',
            'email' => 'prabowo@gmail.com',
            'role' => 'BK',
            'password' => Hash::make('password')
        ]);

        $waliKelas = User::create([
            'nama' => 'Jokowi',
            'nip' => '123456789123456789',
            'email' => 'jokowi@gmail.com',
            'role' => 'Wali Kelas',
            'password' => Hash::make('password')
        ]);

        $kelas = Kelas::create([
            'jenjang' => 'X',
            'kelas' => 'IPA 1',
            'wali_kelas' => $waliKelas->id,
            'tahun_ajaran_id' => $aktif->id,
        ]);

        $siswa = Siswa::create([
            'nisn' => '123456',
            'nama' => 'Putri',
            'jenis_kelamin' => 'P',
        ]);

        KelasSiswa::create([
            'nisn' => $siswa->nisn,
            'kelas_id' => $kelas->id
        ]);

        Pelanggaran::create([
            'pelanggaran' => 'Makan dan minum saat pelajaran berlangsung',
            'skor' => 5,
            'ayat' => '12'
        ]);
    }
}
