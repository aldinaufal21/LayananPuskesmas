<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Exports\ReportDokterExport;
use App\Exports\ReportPemeriksaanExport;
use App\Pemeriksaan;
use App\Poli;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function pemeriksaan()
    {
        $poli = Poli::all();

        return view('report.pemeriksaan', compact('poli'));
    }

    public function exportPemeriksaan(Request $request)
    {
        $tahun = date('Y');
        $poli = $request->id_poli;
        $bulan = $request->month;
        
        return Excel::download(new ReportPemeriksaanExport($bulan, $tahun, $poli), 'report_pemeriksaan.xlsx');
    }

    public function dokter()
    {
        $poli = Poli::all();

        return view('report.dokter', compact('poli'));
    }

    public function exportDokter(Request $request)
    {
        $poli = $request->id_poli;

        return Excel::download(new ReportDokterExport($poli), 'report_dokter.xlsx');
    }
}
