<?php

namespace App\Http\Controllers;

use App\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    //controller web
    
    // lihat antrian
    public function index()
    {
        //data antrian
        $antrian = Antrian::orderBy('tanggal', 'DESC')->orderBy('antrian', 'DESC')->get();

        return view('antrian.index', compact('antrian'));
    }

    // buka antrian
    public function antrianBuka(Request $request)
    {
        //buat status antrian menjadi buka
        $request->session()->put('antrian', 'buka');

        return redirect('/')->with('success', 'Antrian dibuka!');
    }

    // tutup antrian
    public function antrianTutup(Request $request)
    {
        //buat status antrian menjadi tutup
        $request->session()->put('antrian', 'tutup');

        return redirect('/')->with('danger', 'Antrian ditutup!');
    }
}
