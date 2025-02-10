<?php

namespace App\Http\Controllers;

use App\Models\NilaiModel;
use App\Models\SiswaModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function exportPDF(Request $request)
    {
        $siswa = $request->query('siswa');
        $semester = $request->query('semester');
        $dataSiswa = SiswaModel::where('id', $siswa)->first();
        $dataNilai = NilaiModel::where('idsiswa', $siswa)->where('semester', $semester)->get();
        $pdf = Pdf::loadView('pdfnilai', compact('dataNilai', 'dataSiswa', 'semester'));

        return $pdf->download('Nilai - ' . $dataSiswa->nama . '.pdf');
    }
}
