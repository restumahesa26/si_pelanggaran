<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKeputusan extends Model
{
    use HasFactory;

    public $table = 'siswa_keputusan';

    public $fillable = [
        'kelas_siswa_id', 'keputusan', 'user_id'
    ];

    public function kelas_siswa()
    {
        return $this->hasOne(KelasSiswa::class, 'id', 'kelas_siswa_id');
    }

    public function petugas()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
