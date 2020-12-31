<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Pasien;
use App\Pemeriksaan;
use App\Poli;
use App\Praktik;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //controller web
    
    //lihat dashboard
    public function index(Request $request)
    {
        //data dokter
        $dokter = Dokter::all();
        $jumlah_dokter = $dokter->count();

        //data pasien
        $pasien = Pasien::all();
        $jumlah_pasien = $pasien->count();

        //data poli
        $poli = Poli::all();
        $jumlah_poli = $poli->count();

        //data jumlah pemeriksaan berdasarkan status pengajuan
        $pengajuan = 1;
        $pemeriksaan = Pemeriksaan::all()->where('status', $pengajuan);
        $jumlah_pemeriksaan = $pemeriksaan->count();

        $today = date('Y-m-d');
        $praktik = Praktik::whereDate('mulai', '=', $today)->get();
        $jumlah_praktik = $praktik->count();

        //data antrian
        $antrian = $request->session()->get('antrian');

        return view('dashboard.index', compact('jumlah_dokter', 'jumlah_pasien', 'jumlah_poli', 'jumlah_pemeriksaan', 'jumlah_praktik', 'antrian'));
    }

}
