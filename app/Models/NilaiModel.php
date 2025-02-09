<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiModel extends Model
{
    use HasFactory;
    protected $table = 'monitoring_nilai';

    protected $fillable = [
        'idmtpelajaran',
        'idsiswa',
        'semester',
        'nilai',
    ];

    public function idMapel()
    {
        return $this->belongsTo(MataPelajaranModel::class, 'idmtpelajaran', 'id');
    }

    public function idSiswa()
    {
        return $this->belongsTo(SiswaModel::class, 'idsiswa', 'id');
    }
}
