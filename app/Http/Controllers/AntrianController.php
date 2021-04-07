<?php

namespace App\Http\Controllers;

use App\Antrian;
use App\Pemeriksaan;
use App\Praktik;
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

    public function selesai($id)
    {
        $antrian = Antrian::find($id);

        $antrian->status = 2;

        $antrian->save();

        return redirect('/antrian')->with('success','antrian selesai');
    }

    //controller Antrian API

    //lihat antrian berdasarkan id antrian
    public function viewAntrian($id)
    {

        if (Pemeriksaan::where('id_pasien', $id)->exists()) {
            $pemeriksaan = Pemeriksaan::where('id_pasien', $id)->first();
            $status = 1;

            if (Antrian::where('id_pemeriksaan', $pemeriksaan->id)->where('status', $status)->exists()) {
                $antrian = Antrian::where('id_pemeriksaan', $pemeriksaan->id)->where('status', $status)->first();

                $today = date("Y-m-d");
                $praktik = Praktik::whereDate('mulai', '=', $today)->first();

                return response()->json([
                    "status" => 200,
                    "data" => compact('antrian'),
                ], 200);

            } else {
                return response()->json([
                    "status" => 404,
                    "message" => "antrian not found"
                ], 200);
            }    
        } else {
            return response()->json([
                "status" => 404,
                "message" => "user not found"
            ], 200);
        }

    }
}
