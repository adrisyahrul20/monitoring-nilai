<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswaModel extends Model
{
    use HasFactory;
    protected $table = 'nilai_siswa';

    protected $fillable = [
        'idsiswa',
        'tingkat_kelas',
        'ganjil',
        'genap',
    ];

    public function idSiswa()
    {
        return $this->belongsTo(SiswaModel::class, 'idsiswa', 'id');
    }
}
