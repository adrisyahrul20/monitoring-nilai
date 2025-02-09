<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUjianModel extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ujian';

    protected $fillable = [
        'idmtpelajaran',
        'hari_ujian',
        'waktu_mulai',
        'waktu_selesai',
        'idkelas',
        'idguru',
    ];

    public function idMapel()
    {
        return $this->belongsTo(MataPelajaranModel::class, 'idmtpelajaran', 'id');
    }

    public function idKelas()
    {
        return $this->belongsTo(KelasModel::class, 'idkelas', 'id');
    }
    
    public function idGuru()
    {
        return $this->belongsTo(GuruModel::class, 'idguru', 'id');
    }
}
