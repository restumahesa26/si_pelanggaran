<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    public $table = 'kelas_siswa';

    public $fillable = [
        'nisn', 'kelas_id', 'tahun_ajaran_id'
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id', 'kelas_id');
    }
}
