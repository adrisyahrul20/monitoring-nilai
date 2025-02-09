<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaranModel extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'kdmapel',
        'nmmapel',
        'keterangan',
        'idguru',
    ];

    public function idGuru()
    {
        return $this->belongsTo(GuruModel::class, 'idguru', 'id');
    }
}
