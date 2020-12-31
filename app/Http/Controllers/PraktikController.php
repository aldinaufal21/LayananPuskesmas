<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Praktik;
use App\Dokter;
use Carbon\Carbon;

class PraktikController extends Controller
{
    public function index()
    {
        //data praktik
        $praktik = Praktik::All()->sortDesc();

        return view('praktik.index', compact('praktik'));
    }

    public function formTambah()
    {
        //data dokter
        $dokter = Dokter::All()->sortDesc();

        return view('praktik.tambah', compact('dokter'));
    }

    public function add(Request $request)
    {
        //jika data tanggal mulai lebih dari tanggal berakhir
        if($request->mulai > $request->berakhir){
            return back()->with('fail', 'Error! tanggal mulai tidak boleh kurang dari tanggal berakhir');
        }
        else{
            //add data praktik
            $praktik = Praktik::create([
                'mulai' => $request->mulai,
                'berakhir' => $request->berakhir,
                'id_dokter' => $request->id_dokter,
            ]);
    
            return redirect('/praktik')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function formEdit($id)
    {
        //data dokter
        $dokter = Dokter::all()->sortDesc();
        //data praktik berdasarkan id praktik
        $praktik = Praktik::find($id);

        return view('praktik.edit', compact('praktik','dokter'));
    }

    public function update(Request $request, $id)
    {
        //jika data tanggal mulai lebih dari tanggal berakhir
        if($request->mulai > $request->berakhir){
            return back()->with('fail', 'Error! tanggal mulai tidak boleh kurang dari tanggal berakhir');
        }
        else{
            //data praktik berdasarkan id praktik
            $praktik = Praktik::find($id);

            //update data praktik berdasarkan request data
            $praktik->mulai = $request->mulai;
            $praktik->berakhir = $request->berakhir;
            $praktik->id_dokter = $request->id_dokter;

            //update data praktik
            $praktik->save();

            return redirect('/praktik')->with('warning', 'Data berhasil diupdate!');
        }
    }

    public function delete($id)
    {
        //data praktik berdasarkan id praktik
        $praktik = Praktik::find($id);

        //hapus data praktik
        $praktik->delete();

        return redirect('/praktik')->with('danger', 'Data berhasil dihapus!');
    }

    //controller praktik API

    //view data Praktik
    public function viewPraktik()
    {
        //create variable tanggal sekarang
        $today = date('Y-m-d');
        //data praktik berdasarkan tanggal mulai hari ini
        $praktik = Praktik::whereDate('mulai','=',$today)->get();

        return response()->json([
            "status" => 200,
            "data" => compact('praktik'),
        ], 200);
    }
}
