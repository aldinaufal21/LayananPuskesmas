<?php

namespace App\Exports;

use App\Pemeriksaan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PemeriksaanExport implements FromView, ShouldAutoSize
{

    public function view(): View
    {
        $today = date("Y-m-d");
        $cetak = NULL;
        $status = 2;
        $pemeriksaan = Pemeriksaan::whereDate('created_at', "=",$today)->where('cetak', $cetak)->where('status_pemeriksaan', 1)->limit(10)->get();

        foreach($pemeriksaan as $data){
            $update[$data->id] = Pemeriksaan::find($data->id);
            
            $update[$data->id]->cetak = 1;

            $update[$data->id]->save();
        }
        
        return view('pemeriksaan.excel', compact('pemeriksaan'));
    }
}
