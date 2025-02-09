<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'kdkls',
        'tingkat_kelas',
        'jmlbangku',
        'jurusan',
        'idguru',
    ];

    public function idGuru()
    {
        return $this->belongsTo(GuruModel::class, 'idguru', 'id');
    }
}
