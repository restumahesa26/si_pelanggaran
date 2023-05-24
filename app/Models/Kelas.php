<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public $table = 'kelas';

    public $fillable = [
        'kelas', 'jenjang', 'wali_kelas', 'tahun_ajaran_id'
    ];

    public function walikelas()
    {
        return $this->hasOne(User::class, 'id', 'wali_kelas');
    }

    public function siswa()
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id', 'id');
    }
}
