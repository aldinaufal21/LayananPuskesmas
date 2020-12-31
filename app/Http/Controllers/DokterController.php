<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokter;
use App\Poli;

class DokterController extends Controller
{
    //controller web

    //view dokter
    public function index()
    {
        //data dokter
        $dokter = Dokter::All()->sortDesc();

        return view('dokter.index', compact('dokter'));
    }

    //lihat form tambah dokter
    public function formTambah()
    {
        //data poli
        $poli = Poli::All()->sortDesc();

        return view('dokter.tambah', compact('poli'));
    }

    //tambah data dokter
    public function add(Request $request)
    {
        //add data dokter
        Dokter::create([
            'nama' => $request->nama,
            'ttl' => $request->ttl,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'poli_id' => $request->poli_id,
        ]);

        return redirect('/dokter')->with('success', 'Data berhasil ditambahkan!');
    }

    //view form edit
    public function formEdit($id)
    {
        //data poli
        $poli = Poli::all()->sortDesc();
        //data dokter berdasarkan id dokter
        $dokter = Dokter::find($id);

        return view('dokter.edit', compact('dokter','poli'));
    }

    //update data dokter
    public function update(Request $request, $id)
    {
        //data dokter berdasakan id dokter
        $dokter = Dokter::find($id);

        //ubah data dokter sesuai dengan request data update yang diminta
        $dokter->nama = $request->nama;
        $dokter->ttl = $request->ttl;
        $dokter->jenis_kelamin = $request->jenis_kelamin;
        $dokter->alamat = $request->alamat;
        $dokter->poli_id = $request->poli_id;

        //simpan data dokter
        $dokter->save();

        return redirect('/dokter')->with('warning', 'Data berhasil diupdate!');
    }

    //delete dokter
    public function delete($id)
    {
        //data dokter berdasarkan id dokter
        $dokter = Dokter::find($id);

        //hapus data dokter berdasarkan id yang dipilih
        $dokter->delete();

        return redirect('/dokter')->with('danger', 'Data berhasil dihapus!');
    }

    //Controller Dokter API

    //view dokter
    public function viewDokter()
    {
        //data dokter
        $dokter = Dokter::all();

        return response()->json([
            "status" => 200,
            "data" => compact('dokter'),
        ], 200);
    }

    //view dokter where id_dokter
    public function viewDokterID($id)
    {
        //jika data dokter berdasarkan id tersedia
        if(Dokter::find($id)){
            //data dokter berdasarkan id dokter
            $dokter = Dokter::find($id);

            return response()->json([
                "status" => 200,
                "data" => compact('dokter'),
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "dokter not found"
            ], 404);
        }
    }

    //view dokter where poli
    public function viewDokterPoli($id)
    {
        //jika data dokter berdasarkan id_poli tersedia
        if(Dokter::where('poli_id', $id)->exists()){
            //data dokter berdasarkan id poli
            $dokter = Dokter::all()->where('poli_id', $id);

            return response()->json([
                "status" => 200,
                "data" => compact('dokter'),
            ], 200);
        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "dokter not found"
            ]);
        }
    }
}
