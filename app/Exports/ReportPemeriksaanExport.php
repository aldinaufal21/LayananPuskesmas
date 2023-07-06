<?php

namespace App\Exports;

use App\Pemeriksaan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportPemeriksaanExport implements FromView, ShouldAutoSize
{

    protected $bulan;
    protected $poli;
    protected $tahun;

    public function __construct($bulan, $tahun, $poli)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->poli = $poli;
    }

    public function view(): View
    {
        $month = $this->bulan;

        $pemeriksaan = Pemeriksaan::whereMonth('created_at', $this->bulan)->whereYear('created_at', $this->tahun)->where('id_poli', $this->poli)->orderBy('id', 'DESC')->get();
        
        return view('report.export_pemeriksaan', compact('pemeriksaan', 'month'));
    }
}
