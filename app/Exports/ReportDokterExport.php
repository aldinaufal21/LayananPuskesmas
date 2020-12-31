<?php

namespace App\Exports;

use App\Dokter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportDokterExport implements FromView
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
