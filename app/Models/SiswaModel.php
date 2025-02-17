<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa';

    protected $fillable = [
        'id',
        'nis',
        'nama',
        'templahir',
        'tgllahir',
        'jk',
        'alamat',
        'idkelas',
    ];

    public function idKelas()
    {
        return $this->belongsTo(KelasModel::class, 'idkelas', 'id');
    }
}
