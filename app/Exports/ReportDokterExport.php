<?php

namespace App\Exports;

use App\Dokter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportDokterExport implements FromView, ShouldAutoSize
{
    protected $poli;

    public function __construct($poli)
    {
        $this->poli = $poli;
    }

    public function view(): View
    {
        $dokter = Dokter::where('poli_id', $this->poli)->orderBy('id', 'DESC')->get();

        return view('report.export_dokter', compact('dokter'));
    }
}
