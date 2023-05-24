<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaPelanggaran extends Model
{
    use HasFactory;

    public $table = 'siswa_pelanggaran';

    public $fillable = [
        'kelas_siswa_id', 'pelanggaran_id', 'user_id'
    ];

    public function kelas_siswa()
    {
        return $this->hasOne(KelasSiswa::class, 'id', 'kelas_siswa_id');
    }

    public function pelanggaran()
    {
        return $this->hasOne(Pelanggaran::class, 'id', 'pelanggaran_id');
    }

    public function petugas()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
